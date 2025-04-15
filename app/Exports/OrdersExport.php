<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data Order beserta Member
     */
    public function collection()
    {
        
    }

    /**
     * Menentukan header kolom di file Excel
     */
    public function headings(): array
    {
        return [];
    }

    /**
     * Memformat setiap baris sebelum diekspor
     */
    // public function map(): array
    // {
    //    return [];
    // }
}
