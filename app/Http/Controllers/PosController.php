<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('pos.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->input('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong']);
        }

        $invoice = null;

        try {
            DB::transaction(function () use ($cart, &$invoice) {

                $total = 0;

                foreach ($cart as $item) {
                    $product = Product::find($item['id']);
                    if (!$product || $product->stock < $item['qty']) {
                        throw new \Exception("Stok produk {$item['name']} tidak cukup");
                    }

                    $total += $item['price'] * $item['qty'];

                    $product->decrement('stock', $item['qty']);
                }

                $trx = Transaction::create([
                    'invoice' => 'INV-' . date('YmdHis'),
                    'total'   => $total,
                    'user_id' => auth()->id(),
                ]);

                foreach ($cart as $item) {
                    TransactionDetail::create([
                        'transaction_id' => $trx->id,
                        'product_id'     => $item['id'],
                        'qty'            => $item['qty'],
                        'price'          => $item['price'],
                        'subtotal'       => $item['price'] * $item['qty'],
                    ]);
                }

                $invoice = $trx->invoice;
            });

            return response()->json(['success' => true, 'invoice' => $invoice]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function struk($invoice)
    {
        $transaksi = Transaction::with('items.product')->where('invoice', $invoice)->firstOrFail();
        return view('pos.struk', compact('transaksi'));
    }
}
