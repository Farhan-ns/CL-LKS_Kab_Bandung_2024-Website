<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
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
