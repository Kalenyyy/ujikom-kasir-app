<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        .invoice-header {
            text-align: left;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            margin: 0;
            text-align: center;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .summary {
            padding: 10px;
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h2>WarungDoMie</h2>
        <hr>
        @if (!is_null($order->members_id))
            {{-- Perbaikan di sini --}}
            <p>Member Status: Member</p>
            <p>No. HP: {{ $order->member->no_telp }}</p>
            <p>Bergabung Sejak: {{ Carbon\Carbon::parse($order->member->created_at)->format('d F Y') }}</p>
            <p>Poin Member: {{ number_format($order->member->point, 0, ',', '.') }} Point</p>
        @else
            <p>Member Status: Bukan Member</p>
            <p>No. HP: -</p>
            <p>Bergabung Sejak: -</p>
            <p>Poin Member: -</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Harga: Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</p>
        @if (!is_null($order->members_id))
            <p>Poin Digunakan: {{ number_format($order->member_point_used, 0, ',', '.') }} Point</p>
            <p>Harga Setelah Poin: Rp. {{ number_format($order->total_harga_after_point, 0, ',', '.') }}</p>
        @endif
        <p>Uang Pembeli: Rp. {{ number_format($order->customer_pay, 0, ',', '.') }}</p>
        <p>Total Kembalian: Rp. {{ number_format($order->customer_return, 0, ',', '.') }}</p>
    </div>

    <div class="footer">
        <p>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }} | Petugas: {{ $order->user->name }}</p>
        <p>Terima kasih atas pembelian Anda!</p>
    </div>
</body>

</html>
