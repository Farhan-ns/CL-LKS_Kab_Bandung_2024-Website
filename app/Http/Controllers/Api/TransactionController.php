<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Transaction
     * 
     * Membuat transaksi baru
     *
     * @authenticated
     * @bodyParam products.id integer required ID Produk. Example: 1 
     * @bodyParam products.quantity integer required Jumlah Produk. Example: 5
     * @response {"success":true,"code":200,"message":"Transaction successful","data":{"updated_at":"2024-04-29T12:31:43.000000Z","created_at":"2024-04-29T12:31:43.000000Z","id":1,"transaction_details":[{"id":1,"product_id":1,"quantity":2,"subtotal":"12000.00","transaction_id":1,"created_at":"2024-04-29T12:31:44.000000Z","updated_at":"2024-04-29T12:31:44.000000Z","product":{"id":1,"name":"Popmie","price":"6000.00","image":"popmie.png","created_at":"2024-04-29T02:39:59.000000Z","updated_at":"2024-04-29T02:39:59.000000Z","image_link":"https://lks24.cyberlabs.co.id/img/popmie.png"}},{"id":2,"product_id":2,"quantity":2,"subtotal":"12000.00","transaction_id":1,"created_at":"2024-04-29T12:31:44.000000Z","updated_at":"2024-04-29T12:31:44.000000Z","product":{"id":2,"name":"Niu Green Tea Madu","price":"8000.00","image":"niu.png","created_at":"2024-04-29T02:39:59.000000Z","updated_at":"2024-04-29T02:39:59.000000Z","image_link":"https://lks24.cyberlabs.co.id/img/niu.png"}}]}}
     */
    public function makeTransaction(Request $request)
    {
        $validated = $request->validate([
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::beginTransaction();
        $transaction = Transaction::create();

        foreach ($validated['products'] as $key => $product) {
            $productModel = Product::findOrFail($product['id'])->first();
            $subtotal = $productModel->price * $product['quantity'];

            $transaction->transactionDetails()->create([
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        DB::commit();

        return response()->success($transaction->load('transactionDetails', 'transactionDetails.product'), 'Transaction successful');
    }
}
