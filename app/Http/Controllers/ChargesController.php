<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargesRequest;

class ChargesController extends Controller
{
    public function store(ChargesRequest $request)
    {
        $charge = $request->user()->charges()->create($request->all());

        return response()->json([
            'message' => '요청 성공했습니다.',
            'charge' => $charge
        ], 200);
    }
}