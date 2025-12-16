<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 4px 0; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h3>Struk Pembelian</h3>

<p>ID Transaksi: {{ $transaksi->id }}</p>
<p>Tanggal: {{ $transaksi->created_at }}</p>

<table>
    @foreach ($transaksi->items as $item)
        <tr>
            <td>{{ $item->product->nama }}</td>
            <td class="right">{{ $item->qty }} x {{ number_format($item->harga) }}</td>
        </tr>
    @endforeach
</table>

<hr>

<p class="right"><strong>Total: {{ number_format($transaksi->total) }}</strong></p>

<button onclick="confirmPrint()"
        class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
    Print Struk
</button>


</body>
</html>
