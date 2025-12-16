<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::with('category')->get(); // eager load kategori
    return view('admin.products.index', compact('products'));
}


public function create()
{
    $categories = Category::all(); // ambil semua kategori
    return view('admin.products.create', [
        'product' => new Product(),
        'categories' => $categories
    ]);
}


    public function store(Request $request)
{
    $attr = $request->validate([
        'name'  => 'required|string|max:255',
        'sku'   => 'required|string|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $attr['image'] = $request->file('image')
            ->store('products', 'public');
    }

    Product::create($attr);

    return redirect()->route('admin.products.index')
        ->with('success', 'Produk berhasil ditambahkan');
}

public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.create', compact('product','categories'));
}


    public function update(Request $request, Product $product)
{
    $attr = $request->validate([
        'name'        => 'required|string|max:255',
        'sku'         => 'required|string|unique:products,sku,' . ($product->id ?? 'NULL'),
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|max:2048',
    ]);
    

    if ($request->hasFile('image')) {
        $attr['image'] = $request->file('image')
            ->store('products', 'public');
    }

    $product->update($attr);

    return redirect()->route('admin.products.index')
        ->with('success', 'Produk berhasil diupdate');
}


    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Produk dihapus');
    }

    public function laporan()
{
    $hari = Transaction::whereDate('created_at', today())
        ->sum('profit');

    $bulan = Transaction::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('profit');

    $totalHariIni = Transaction::whereDate('created_at', today())
        ->count();

    $transactions = Transaction::with('kasir')
        ->latest()
        ->get();

    return view('admin.laporan', compact(
        'hari',
        'bulan',
        'totalHariIni',
        'transactions'
    ));
    
}
}