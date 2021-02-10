<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SalesHistoryController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->salesHistory()
        ]);
    }

    public function show(Request $request, Product $product)
    {
        return $request->user()->salesDetails($product);
    }
}