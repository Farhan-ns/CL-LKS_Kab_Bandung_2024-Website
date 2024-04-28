<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(['name'])
            ->get();

        return response()->success($products, 'List of products fetched', 200);
    }
}
