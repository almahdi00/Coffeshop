@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6 relative">

    <!-- Tombol Keranjang -->
    <div class="fixed top-6 right-6 z-50">
        <button id="cartBtn" class="relative bg-yellow-400 text-gray-900 px-4 py-2 rounded-full font-bold shadow-lg hover:shadow-xl transition">
            Keranjang
            <span id="count" class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 text-xs rounded-full flex items-center justify-center">0</span>
        </button>

        <!-- Cart Balloon -->
        <div id="cartBalloon" class="hidden absolute right-0 mt-2 w-96 bg-gradient-to-b from-gray-900 to-black text-white p-6 rounded-2xl shadow-xl flex flex-col">
            <h2 class="text-2xl font-extrabold mb-4">KERANJANG</h2>
            <div id="items" class="flex-1 max-h-64 overflow-y-auto space-y-3 pr-2 scrollbar-thin scrollbar-thumb-gray-700"></div>
            <div class="border-t-2 border-gray-700 pt-4 space-y-2">
                <div class="flex justify-between text-lg">
                    <span>Total</span>
                    <span id="total" class="font-bold">Rp 0</span>
                </div>
                <div>
                    <label for="bayar_uang" class="block text-gray-200 mb-1">Uang Bayar:</label>
                    <input type="number" id="bayar_uang" placeholder="Masukkan jumlah uang" 
                           class="w-full px-3 py-2 rounded-lg text-black text-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="flex justify-between text-lg mt-1">
                    <span>Kembalian</span>
                    <span id="kembalian" class="font-bold">Rp 0</span>
                </div>
            </div>

            <button onclick="bayar()" class="mt-4 w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-lg font-bold py-3 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                BAYAR
            </button>

            <button onclick="batalTransaksi()" class="mt-2 w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-lg font-bold py-3 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                BATALKAN
            </button>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-6 rounded-2xl shadow-xl">
        <input type="text" id="search" placeholder="Cari menu..."
               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-lg">
    </div>

    <!-- Pilih Produk -->
    <div class="bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Menu</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @foreach($products as $p)
            <button
                data-name="{{ strtolower($p->name) }}"
                onclick="add({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->price }}, {{ $p->stock }})"
                class="product-item group bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-200 {{ $p->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $p->stock <= 0 ? 'disabled' : '' }}>
                
                <div class="aspect-square bg-gray-50 overflow-hidden">
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <i class="fas fa-image text-4xl text-gray-300"></i>
                        </div>
                    @endif
                </div>

                <div class="p-4 text-center">
                    <h3 class="font-semibold text-gray-800 text-sm line-clamp-2 min-h-10">{{ $p->name }}</h3>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Kategori: {{ $p->category?->name ?? '-' }}</p>
                    <p class="text-lg font-bold text-indigo-600 mt-2">Rp {{ number_format($p->price) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Stok: <span class="{{ $p->stock <= 5 ? 'text-red-500 font-bold' : '' }}">{{ $p->stock }}</span></p>
                </div>
            </button>
            @endforeach
        </div>
    </div>

</div>

<script>
let cart = [];

// Toggle balloon cart
document.getElementById('cartBtn').addEventListener('click', () => {
    const balloon = document.getElementById('cartBalloon');
    balloon.classList.toggle('hidden');
});

// Tambah produk ke cart
function add(id, name, price, stock) {
    if (stock <= 0) return alert('Stok habis!');
    let item = cart.find(x => x.id == id);
    if (item) item.qty++;
    else cart.push({id, name, price, qty:1});
    render();
}

// Render cart
function render() {
    let total = 0, count = 0;
    document.getElementById('items').innerHTML = cart.map(i => {
        total += i.price * i.qty;
        count += i.qty;
        return `<div class="bg-gray-800 p-3 rounded flex justify-between">
                    <div><div class="font-semibold">${i.name}</div><small>${i.price.toLocaleString()} X ${i.qty}</small></div>
                    <div class="text-right">Rp ${(i.price*i.qty).toLocaleString()}</div>
                </div>`;
    }).join('');

    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString();
    document.getElementById('count').textContent = count;

    const bayarInput = parseInt(document.getElementById('bayar_uang').value) || 0;
    const kembalian = bayarInput - total;
    document.getElementById('kembalian').textContent = kembalian >= 0 ? 'Rp ' + kembalian.toLocaleString() : 'Rp 0';
}

document.getElementById('bayar_uang').addEventListener('input', render);

// BAYAR
async function bayar() {
    if (cart.length == 0) return alert('Keranjang kosong!');
    const uangBayar = parseInt(document.getElementById('bayar_uang').value);
    const total = cart.reduce((sum, i) => sum + i.price * i.qty, 0);
    if (isNaN(uangBayar) || uangBayar < total) return alert('Uang bayar kurang!');

    if (!confirm("Yakin ingin memproses pembayaran?")) return;

    try {
        const res = await fetch("{{ route('pos.checkout') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ cart })
        });

        const data = await res.json();

        if (!data.success) return alert(data.message || "Gagal memproses transaksi");

        cart = [];
        document.getElementById('bayar_uang').value = '';
        render();
        document.getElementById('cartBalloon').classList.add('hidden');
        window.location.href = "/pos/struk/" + data.invoice;

    } catch (err) {
        console.error(err);
        alert("Gagal memproses transaksi");
    }
}

// BATALKAN
function batalTransaksi() {
    if (!confirm("Yakin batal?")) return;
    cart = [];
    document.getElementById('bayar_uang').value = '';
    render();
}

// SEARCH
document.getElementById('search').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    document.querySelectorAll('.product-item').forEach(item => {
        const productName = item.dataset.name;
        item.style.display = productName.includes(searchTerm) ? '' : 'none';
    });
});

</script>
@endsection
