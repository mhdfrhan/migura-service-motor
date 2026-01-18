<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $search;
    protected $filterRole;
    protected $filterStatus;

    public function __construct($search = '', $filterRole = 'all', $filterStatus = 'all')
    {
        $this->search = $search;
        $this->filterRole = $filterRole;
        $this->filterStatus = $filterStatus;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->filterRole !== 'all') {
            $query->where('role', $this->filterRole);
        }

        if ($this->filterStatus !== 'all') {
            $query->where('is_active', $this->filterStatus === 'active');
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Telepon',
            'Alamat',
            'Role',
            'Status',
            'Loyalty Points',
            'Total Booking',
            'Terdaftar',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone ?? '-',
            $user->address ?? '-',
            ucfirst($user->role),
            $user->is_active ? 'Aktif' : 'Nonaktif',
            $user->loyalty_points ?? 0,
            $user->total_bookings ?? 0,
            $user->created_at->format('d M Y, H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 30,
            'C' => 35,
            'D' => 18,
            'E' => 35,
            'F' => 12,
            'G' => 12,
            'H' => 15,
            'I' => 15,
            'J' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3B82F6'], // Blue-500
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ]);

        // Set row height for header
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Data rows style
        $highestRow = $sheet->getHighestRow();
        if ($highestRow > 1) {
            $sheet->getStyle('A2:J'.$highestRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'E5E7EB'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);

            // Alternate row colors
            for ($row = 2; $row <= $highestRow; $row++) {
                if ($row % 2 == 0) {
                    $sheet->getStyle('A'.$row.':J'.$row)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F9FAFB'],
                        ],
                    ]);
                }
            }
        }

        // Auto filter
        $sheet->setAutoFilter('A1:J1');

        return $sheet;
    }

    public function title(): string
    {
        return 'Users';
    }
}
