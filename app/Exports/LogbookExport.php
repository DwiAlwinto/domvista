<?php

namespace App\Exports;

use App\Models\Logbook;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LogbookExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnWidths
{
    protected $logbook;

    public function __construct(Logbook $logbook)
    {
        $this->logbook = $logbook;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->logbook->entries as $entry) {
            $data[] = [
                'No' => count($data) + 1,
                'Logbook Number' => $this->logbook->logbook_number,
                'Date' => $this->logbook->logbook_date->format('d M Y'),
                'Tower' => $entry->tower,
                'Unit' => $entry->unit,
                'Work Description' => strip_tags($entry->description),
                'Work Result' => $entry->result ? strip_tags($entry->result) : '-',
                'Status' => $entry->status,
                'Created At' => $entry->created_at->format('d M Y, H:i'),
                'Time Done' => $entry->time_done ?? '-',
                'Completed By' => $entry->userDone?->name ?? '-',
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Logbook Number',
            'Date',
            'Tower',
            'Unit',
            'Work Description',
            'Work Result',
            'Status',
            'Created At',
            'Time Done',
            'Completed By',
        ];
    }

    public function title(): string
    {
        return 'Logbook Report';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 18,  // Logbook Number
            'C' => 15,  // Date
            'D' => 12,  // Tower
            'E' => 12,  // Unit
            'F' => 40,  // Work Description
            'G' => 40,  // Work Result
            'H' => 15,  // Status
            'I' => 18,  // Created At
            'J' => 15,  // Time Done
            'K' => 20,  // Completed By
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $rowCount = $this->logbook->entries->count() + 1; // header + data rows

        return [
            // Header row style
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '2980b9'], // Dark blue
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],

            // Data rows
            "A2:K{$rowCount}" => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_HAIR,
                        'color' => ['argb' => 'CCCCCC'],
                    ],
                ],
            ],

            // Center align for specific columns
            'A' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'B' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'C' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'D' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'E' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'H' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'I' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'J' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],

            // Left align with wrap text
            'F' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            'G' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            'K' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $logbook = $this->logbook;
                $lastRow = $logbook->entries->count() + 1;

                // Set row height untuk wrap text
                for ($row = 2; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30); // tinggi minimum
                }

                // Auto size opsional (jika ingin tambahan fleksibilitas)
                foreach (range('A', 'K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(false); // gunakan lebar tetap dari columnWidths
                }

                // Add filter on header
                $sheet->setAutoFilter("A1:K1");

                // Optional: Freeze header row
                $sheet->freezePane('A2');

                // Tambahkan informasi logbook di atas tabel
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells('A1:K1');
                $sheet->setCellValue('A1', "LOGBOOK REPORT - {$logbook->logbook_number}");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => '2c3e50']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->mergeCells('A2:K2');
                $sheet->setCellValue('A2', "Date: {$logbook->logbook_date->format('d F Y')} | Generated on: " . now()->format('d M Y, H:i'));
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'color' => ['argb' => '7f8c8d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }
}
