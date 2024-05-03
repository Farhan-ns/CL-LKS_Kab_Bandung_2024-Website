<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Produk
     * 
     * Mengambil list produk
     * 
     * @authenticated
     * @queryParam filter[name] Memfilter produk berdasarkan nama. Example: Oreo
     * 
     * @response {"success":true,"code":200,"message":"List of products fetched","data":[{"id":1,"name":"Popmie","price":"6000.00","image":"popmie.png","created_at":"2024-04-29T02:39:59.000000Z","updated_at":"2024-04-29T02:39:59.000000Z","image_link":"https://lks24.cyberlabs.co.id/img/popmie.png"}]}
     */
    public function __invoke(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(['name'])
            ->get();

        return response()->success($products, 'List of products fetched', 200);
    }
}
