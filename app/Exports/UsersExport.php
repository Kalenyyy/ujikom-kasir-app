<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithCustomStartCell, WithEvents
{
    /**
     * Mengambil data Order beserta relasi
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'Username',
            'Email',
            'Role',
        ];
    }

    /**
     * Format setiap baris sebelum diekspor
     */
    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->role,
        ];
    }

    /**
     * Tentukan sel awal untuk data
     */
    public function startCell(): string
    {
        return 'A2';
    }

    /**
     * Event untuk menambahkan judul di A1
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet;

                // Set value for A1
                $sheet->setCellValue('A1', 'WarungDoMie');

                // Apply styles to A1
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16, // Set font size
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ]);

                // Merge cells for title
                $sheet->mergeCells('A1:C1'); // Adjust range based on your headings
            },
        ];
    }
}
