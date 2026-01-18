<?php

namespace App\Exports;

use App\Models\ActivityLog;
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

class ActivityLogsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = ActivityLog::with('user');

        if (isset($this->filters['filterRole']) && $this->filters['filterRole'] !== 'all') {
            $query->whereHas('user', function ($q) {
                $q->where('role', $this->filters['filterRole']);
            });
        }

        if (isset($this->filters['filterAction']) && $this->filters['filterAction'] !== 'all') {
            $query->where('action', $this->filters['filterAction']);
        }

        if (isset($this->filters['search']) && $this->filters['search']) {
            $query->where(function ($q) {
                $q->where('action', 'like', '%'.$this->filters['search'].'%')
                    ->orWhere('model_type', 'like', '%'.$this->filters['search'].'%')
                    ->orWhereHas('user', function ($u) {
                        $u->where('name', 'like', '%'.$this->filters['search'].'%')
                            ->orWhere('email', 'like', '%'.$this->filters['search'].'%');
                    });
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Email',
            'Role',
            'Action',
            'Model Type',
            'Model ID',
            'IP Address',
            'Waktu',
        ];
    }

    public function map($log): array
    {
        return [
            $log->id,
            $log->user->name ?? 'System',
            $log->user->email ?? '-',
            $log->user->role ?? '-',
            ucfirst(str_replace('_', ' ', $log->action)),
            $log->model_type ?? '-',
            $log->model_id ?? '-',
            $log->ip_address ?? '-',
            $log->created_at->format('d M Y, H:i:s'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 30,
            'D' => 12,
            'E' => 25,
            'F' => 20,
            'G' => 12,
            'H' => 18,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0EA5E9'], // Sky-500
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
            $sheet->getStyle('A2:I'.$highestRow)->applyFromArray([
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
                    $sheet->getStyle('A'.$row.':I'.$row)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F9FAFB'],
                        ],
                    ]);
                }
            }
        }

        // Auto filter
        $sheet->setAutoFilter('A1:I1');

        return $sheet;
    }

    public function title(): string
    {
        return 'Activity Logs';
    }
}
