<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Carbon\Carbon;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize,  WithCustomStartCell, WithEvents
{
    /**
     * Mengambil data Order beserta relasi
     */
    public function collection()
    {
        return Order::with('member', 'user')->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'Nama Member',
            'No Hp Pelanggan',
            'Poin Pelanggan',
            'Produk',
            'Total Harga',
            'Total Bayar',
            'Total Diskon Poin',
            'Total Kembalian',
            'Tanggal Penjualan'
        ];
    }

    /**
     * Format setiap baris sebelum diekspor
     */
    public function map($order): array
    {
        $member = $order->member;

        // Format produk
        $products = collect(json_decode($order->products, true))->map(function ($product) use ($member, $order) {
            return [
                $member ? $member->name_member : 'Bukan Member',
                $member ? $member->no_telp : '-',
                $order->members_id
                    ? 'Rp. ' . number_format((int) $member->point, 0, ',', '.')
                    : '0',
                "{$product['name']} ( {$product['id']} : Rp. " . number_format((int) $product['price'], 0, ',', '.') . " )",
                'Rp. ' . number_format((int) $order->total_harga, 0, ',', '.'),
                'Rp. ' . number_format((int) $order->customer_pay, 0, ',', '.'),
                $order->member_point_used
                    ? 'Rp. ' . number_format((int) $order->member_point_used, 0, ',', '.')
                    : 'Rp. 0',
                'Rp. ' . number_format((int) $order->customer_return, 0, ',', '.'),
                Carbon::parse($order->tanggal_penjualan)
                    ->locale('id')
                    ->translatedFormat('l, d F Y, H:i:s') . ' WIB',
            ];
        });

        // Tambahkan baris pertama untuk data utama
        $rows = $products->toArray();
        $rows[0][0] = $member ? $member->name_member : 'Bukan Member'; // Nama Member hanya di baris pertama
        $rows[0][1] = $member ? $member->no_telp : '-'; // No Hp Pelanggan hanya di baris pertama
        $rows[0][2] = $order->members_id
            ? 'Rp. ' . number_format((int) $member->point, 0, ',', '.')
            : '0'; // Poin Pelanggan hanya di baris pertama

        // Kosongkan kolom lainnya di baris produk berikutnya
        for ($i = 1; $i < count($rows); $i++) {
            $rows[$i][0] = '';
            $rows[$i][1] = '';
            $rows[$i][2] = '';
            $rows[$i][4] = '';
            $rows[$i][5] = '';
            $rows[$i][6] = '';
            $rows[$i][7] = '';
            $rows[$i][8] = ''; // Kosongkan Tanggal Penjualan
        }

        return $rows;
    }

    /**
     * Styling untuk header
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
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Merge cells for title
                $sheet->mergeCells('A1:C1'); // Adjust range based on your headings
            },
        ];
    }
}
