<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Product $product)
    {
        $product->favorites()->attach(auth()->id());

        return response()->json(null, 204);
    }

    public function destroy(Product $product)
    {
        $product->favorites()->detach(auth()->id());

        return response()->json(null, 204);
    }
}