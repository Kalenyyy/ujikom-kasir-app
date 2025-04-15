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
        <h2>Ini Warung</h2>
        <hr>
        <p>Member Status: Member</p>
        <p>No. HP: 08123456789</p>
        <p>Bergabung Sejak: 01 Januari 2024</p>
        <p>Poin Member: 120 Point</p>
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
            <tr>
                <td>Teh Leci</td>
                <td>2</td>
                <td>Rp. 5.000</td>
                <td>Rp. 10.000</td>
            </tr>
            <tr>
                <td>Teh Lemon</td>
                <td>1</td>
                <td>Rp. 6.000</td>
                <td>Rp. 6.000</td>
            </tr>
        </tbody>
    </table>

    <div class="summary">
        <p>Total Harga: Rp. 16.000</p>
        <p>Poin Digunakan: 20 Point</p>
        <p>Harga Setelah Poin: Rp. 14.000</p>
        <p>Uang Pembeli: Rp. 20.000</p>
        <p>Total Kembalian: Rp. 6.000</p>
    </div>

    <div class="footer">
        <p>2025-04-14 14:30:00 | Petugas: Budi</p>
        <p>Terima kasih atas pembelian Anda!</p>
    </div>

</body>

</html>
