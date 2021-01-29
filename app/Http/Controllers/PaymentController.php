<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'selectIds' => 'required|array',
            'quantityList' => 'required|array',
        ]);

        $selectOptions = [];
        $selectIds = $request->input('selectIds');
        for ($i = 0; $i < count($selectIds); $i++) {
            $selectOptions[$i] = Price::find($selectIds[$i]);
            $selectOptions[$i]->quantity = $request->input('quantityList')[$i];
        }

        $total = $this->getTotalPrice($selectOptions);

        // 구매금액이 유저money 보다 크면 403반환
        if ($total > auth()->user()->money) {
            return response()->json(['error' => '충전금이 부족합니다.'], 403);
        }

        foreach ($selectOptions as $option) {
            if ($option->quantity < 1 ) {
                return response()->json(['error' => '수량을 정확하게 입력하세요.'], 403);
            }
            else if ($option->code_quantity < $option->quantity) {
                return response()->json(['error' => '재고가 부족합니다.'], 403);
            }
        }

        return response()->json([
            'total' => $total
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => new PaymentResource($product)
        ], 200);
    }

    public function getTotalPrice($selectOptions)
    {
        $result = 0;
        foreach ($selectOptions as $option) {
            $result += $option->price * $option->quantity;
        }

        return $result;
    }
}