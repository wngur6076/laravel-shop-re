<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->posts()
        ]);
    }

    public function show(Request $request, Product $product)
    {
        return response()->json([
            'data' => $request->user()->postsDetails($product)
        ]);
    }
}