<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->posts()
        ]);
    }
}