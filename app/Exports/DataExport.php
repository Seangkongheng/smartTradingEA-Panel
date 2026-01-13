<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DataExport implements FromCollection, WithEvents
{
    protected $data;
    protected $startDate;
    protected $endDate;

    public function __construct($data, $startDate, $endDate)
    {
        $this->data = $data; // Collection of schools with daily stats
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return collect([]); // Empty, we use AfterSheet for styling & writing
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $currentRow = 1;

                // Set default Khmer font
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Khmer OS Siemreap');

                // Header
                $sheet->setCellValue('A1', 'ទិន្នន័យសរុបនៃសាលានីមួយៗ');
                $sheet->mergeCells('A1:F1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'name' => 'Khmer OS Muol'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->setCellValue('A2', "ចាប់ពីថ្ងៃទី {$this->startDate} រហូតដល់ថ្ងៃទី {$this->endDate}");
                $sheet->mergeCells('A2:F2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'name' => 'Khmer OS Muol'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $currentRow = 3;

                // Group by province
                $groupedData = $this->data->groupBy('province.kh_name');

                foreach ($groupedData as $provinceName => $schools) {

                    // Province header
                    $sheet->setCellValue("A{$currentRow}", "ខេត្ត-រាជធានី: " . $provinceName);
                    $sheet->getStyle("A{$currentRow}")->applyFromArray([
                        'font' => ['bold' => true],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E8F4F8']
                        ]
                    ]);
                    $currentRow++;

                    foreach ($schools as $school) {

                        // School Name
                        $sheet->setCellValue("A{$currentRow}", "- " . $school->kh_name);
                        $sheet->getStyle("A{$currentRow}")->applyFromArray([
                            'font' => ['bold' => true],
                        ]);
                        $currentRow++;

                        // Table Headers
                        $headers = ['ល.រ', 'ថ្ងៃ-ខែ-ឆ្នាំ', 'ចំនួនសិស្សចុះឈ្មោះ', 'ប្រុស', 'ស្រី', 'ចំនួនអ្នកមើលសរុប'];
                        $cols = ['A', 'B', 'C', 'D', 'E', 'F'];
                        foreach ($cols as $i => $col) {
                            $sheet->setCellValue("{$col}{$currentRow}", $headers[$i]);
                        }

                        $sheet->getStyle("A{$currentRow}:F{$currentRow}")->applyFromArray([
                            'font' => ['bold' => true],
                            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                            'borders' => [
                                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                            ],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'E8F4F8'] // Light blue header
                            ]
                        ]);

                        $currentRow++;

                        // Daily records
                        $rowNumber = 1;
                        $schoolTotalViews = 0;
                        $schoolTotalStudents = 0;
                        $schoolTotalMale = 0;
                        $schoolTotalFemale = 0;

                        foreach ($school->daily as $item) {
                            $sheet->setCellValue("A{$currentRow}", $rowNumber);
                            $sheet->setCellValue("B{$currentRow}", Carbon::parse($item->day)->format('d-M-Y'));
                            $sheet->setCellValue("C{$currentRow}", $item->students ?? 0);
                            $sheet->setCellValue("D{$currentRow}", $item->male ?? 0);
                            $sheet->setCellValue("E{$currentRow}", $item->female ?? 0);
                            $sheet->setCellValue("F{$currentRow}", $item->views ?? 0);

                            $sheet->getStyle("A{$currentRow}:F{$currentRow}")->applyFromArray([
                                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                                'borders' => [
                                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                                ]
                            ]);

                            $rowNumber++;
                            $currentRow++;

                            // Totals
                            $schoolTotalViews += $item->views ?? 0;
                            $schoolTotalStudents += $item->students ?? 0;
                            $schoolTotalMale += $item->male ?? 0;
                            $schoolTotalFemale += $item->female ?? 0;
                        }

                        // Total row
                        $sheet->setCellValue("A{$currentRow}", "សរុប");
                        $sheet->setCellValue("C{$currentRow}", $schoolTotalStudents);
                        $sheet->setCellValue("D{$currentRow}", $schoolTotalMale);
                        $sheet->setCellValue("E{$currentRow}", $schoolTotalFemale);
                        $sheet->setCellValue("F{$currentRow}", $schoolTotalViews);

                        $sheet->getStyle("A{$currentRow}:F{$currentRow}")->applyFromArray([
                            'font' => ['bold' => true],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'FFE699']
                            ],
                            'borders' => [
                                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                            ]
                        ]);

                        $currentRow += 2;
                    }

                    $currentRow++;
                }



                // Set fixed column widths
                $sheet->getColumnDimension('A')->setWidth(8);  // ល.រ
                $sheet->getColumnDimension('B')->setWidth(15); // ថ្ងៃ
                $sheet->getColumnDimension('C')->setWidth(25); // ចំនួនសិស្សចុះឈ្មោះ
                $sheet->getColumnDimension('D')->setWidth(10); // ប្រុស
                $sheet->getColumnDimension('E')->setWidth(10); // ស្រី
                $sheet->getColumnDimension('F')->setWidth(15); // ចំនួនអ្នកមើលសរុប
            }
        ];
    }
}
