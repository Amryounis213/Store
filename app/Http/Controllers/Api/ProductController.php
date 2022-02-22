<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id = null)
    {
        $products = Product::where('status', 'Active')->when($id, function ($query) use ($id) {
            $query->where('category_id', $id);
        })->paginate(10);

        return response()->json([

            'status' => true,
            'code' => 200,
            'message' => 'All Categories return',
            'products' => ProductResource::collection($products),

        ]);
    }
}
