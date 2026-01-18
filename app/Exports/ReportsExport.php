<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\PaymentProof;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReportsExport implements WithMultipleSheets
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->endOfDay();

        return [
            new BookingsReportSheet($start, $end),
            new PaymentsReportSheet($start, $end),
            new CustomersReportSheet($start, $end),
        ];
    }
}

class BookingsReportSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Booking::with(['user', 'servicePackage', 'engineCapacity'])
            ->whereBetween('created_at', [$this->start, $this->end])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Customer',
            'Email',
            'Paket Layanan',
            'Kapasitas Mesin',
            'Tanggal Booking',
            'Total Harga',
            'Status',
            'Dibuat',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->booking_code,
            $booking->user->name,
            $booking->user->email,
            $booking->servicePackage->name,
            $booking->engineCapacity->name,
            $booking->booking_date->format('d M Y, H:i'),
            formatRupiah($booking->total_price),
            ucfirst(str_replace('_', ' ', $booking->status)),
            $booking->created_at->format('d M Y, H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 25,
            'C' => 30,
            'D' => 25,
            'E' => 18,
            'F' => 20,
            'G' => 18,
            'H' => 18,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0EA5E9']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $highestRow = $sheet->getHighestRow();
        if ($highestRow > 1) {
            $sheet->getStyle('A2:I'.$highestRow)->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            for ($row = 2; $row <= $highestRow; $row++) {
                if ($row % 2 == 0) {
                    $sheet->getStyle('A'.$row.':I'.$row)->applyFromArray([
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
                    ]);
                }
            }
        }
        $sheet->setAutoFilter('A1:I1');
        return $sheet;
    }

    public function title(): string
    {
        return 'Bookings';
    }
}

class PaymentsReportSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return PaymentProof::with(['booking.user', 'verifier'])
            ->whereBetween('created_at', [$this->start, $this->end])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Booking',
            'Customer',
            'Metode Pembayaran',
            'Bank',
            'Jumlah',
            'Status Verifikasi',
            'Diverifikasi Oleh',
            'Dibuat',
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->booking->booking_code,
            $payment->booking->user->name,
            ucfirst(str_replace('_', ' ', $payment->payment_method)),
            $payment->bank_name ?? '-',
            formatRupiah($payment->amount),
            ucfirst($payment->verification_status),
            $payment->verifier->name ?? '-',
            $payment->created_at->format('d M Y, H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 18,
            'C' => 25,
            'D' => 20,
            'E' => 20,
            'F' => 18,
            'G' => 18,
            'H' => 25,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '10B981']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $highestRow = $sheet->getHighestRow();
        if ($highestRow > 1) {
            $sheet->getStyle('A2:I'.$highestRow)->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            for ($row = 2; $row <= $highestRow; $row++) {
                if ($row % 2 == 0) {
                    $sheet->getStyle('A'.$row.':I'.$row)->applyFromArray([
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
                    ]);
                }
            }
        }
        $sheet->setAutoFilter('A1:I1');
        return $sheet;
    }

    public function title(): string
    {
        return 'Payments';
    }
}

class CustomersReportSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return User::where('role', 'customer')
            ->whereBetween('created_at', [$this->start, $this->end])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Telepon',
            'Alamat',
            'Loyalty Points',
            'Total Booking',
            'Status',
            'Terdaftar',
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->email,
            $customer->phone ?? '-',
            $customer->address ?? '-',
            $customer->loyalty_points ?? 0,
            $customer->total_bookings ?? 0,
            $customer->is_active ? 'Aktif' : 'Nonaktif',
            $customer->created_at->format('d M Y, H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 30,
            'D' => 18,
            'E' => 35,
            'F' => 15,
            'G' => 15,
            'H' => 12,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '3B82F6']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $highestRow = $sheet->getHighestRow();
        if ($highestRow > 1) {
            $sheet->getStyle('A2:I'.$highestRow)->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            for ($row = 2; $row <= $highestRow; $row++) {
                if ($row % 2 == 0) {
                    $sheet->getStyle('A'.$row.':I'.$row)->applyFromArray([
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
                    ]);
                }
            }
        }
        $sheet->setAutoFilter('A1:I1');
        return $sheet;
    }

    public function title(): string
    {
        return 'Customers';
    }
}
