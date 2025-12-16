<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian</title>
    <style>
        body { font-family: monospace; width: 300px; margin: auto; }
        .center { text-align: center; }
        .line { border-bottom: 1px dashed #333; margin: 10px 0; }
        table { width: 100%; font-size: 14px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <h2 class="center">CoffeShop</h2>
    <div class="center">Jl. Testing No. 123</div>
    <div class="center">Telp: 0812-3456-7890</div>

    <div class="line"></div>

    <p>ID Transaksi: <strong>{{ $transaksi->id }}</strong></p>
    <p>Tanggal: {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>

    <div class="line"></div>

    <table>
    @foreach ($transaksi->items as $item)
    <tr>
        <td colspan="3"><strong>{{ $item->product->name }}</strong></td>
    </tr>
    <tr>
        <td>Rp {{ number_format($item->price, 0) }}</td>
        <td class="center">x{{ $item->qty }}</td>
        <td style="text-align:right;">Rp {{ number_format($item->subtotal, 0) }}</td>
    </tr>
    @endforeach
</table>
    <div class="line"></div>

    <p>Total: <strong>Rp {{ number_format($transaksi->total, 0) }}</strong></p>

    <div class="line"></div>

    <p class="center">Terima kasih telah berbelanja!</p>

    <button onclick="window.location.href = '/pos'"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 mt-4">
        Kembali
    </button>
    
<script>
    window.onload = function() {
        window.print();
    };
</script>



</body>
</html>
