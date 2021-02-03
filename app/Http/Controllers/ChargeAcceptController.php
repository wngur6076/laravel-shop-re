<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChargeResource;
use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeAcceptController extends Controller
{
    public function index()
    {
        $charges = Charge::latest()->get();

        return ChargeResource::collection($charges);
    }

    public function store(Request $request)
    {
        $request->validate([
            'selectIds' => 'required|array',
        ]);

        $charges = Charge::whereIn('id', $request->input('selectIds'))->delete();

        return response()->json([
            'message' => '결제 성공했습니다.',
            'selectIds' => $charges
        ], 200);
    }
}