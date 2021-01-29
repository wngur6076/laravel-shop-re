<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'selectIds' => 'required|array',
            'quantityList' => 'required|array',
        ]);

        $selectOptions = [];
        $maxQuantityList = [];
        $selectIds = $request->input('selectIds');
        for ($i = 0; $i < count($selectIds); $i++) {
            $selectOptions[$i] = Price::find($selectIds[$i]);
            $selectOptions[$i]->purchase_quantity = $request->input('quantityList')[$i];
            $maxQuantityList[$i] = $product->getCodeQuantity($selectOptions[$i]->period);
        }

        $totalPrice = $this->getTotalPrice($selectOptions);

        // 구매금액이 유저money 보다 크면 403반환
        if ($totalPrice > auth()->user()->money)
            return response()->json(['error' => '충전금이 부족합니다.'], 403);

        // 재고가 있는지 체크하는 함수
        $message = $this->inventoryManagement(collect($selectOptions)->pluck('purchase_quantity'), $maxQuantityList);
        if (isset($message['error']))
            return response()->json($message, 403);


        /* foreach ($selectOptions as $i => $option) {
            if ($option->code_quantity == $option->purchase_quantity) {
                $option->where('product_id', $option->product_id)->wherePeriod($option->period)->offset(0)->limit($option->purchase_quantity)->get();
            } else {
                $option->where('product_id', $option->product_id)->wherePeriod($option->period)->offset(1)->limit($option->purchase_quantity)->get();
            }
        } */

        return response()->json([
            'totalPrice' => $totalPrice
        ], 200);
    }

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
            $result += $option->price * $option->purchase_quantity;
        }
        return $result;
    }

    public function inventoryManagement($purchaseQuantityList, $maxQuantityList)
    {
        foreach ($purchaseQuantityList as $i => $purchaseQuantity) {
            if ($purchaseQuantity < 1 )
                return ['error' => '수량을 정확하게 입력하세요.'];
            else if ($maxQuantityList[$i] < $purchaseQuantity)
                return ['error' => '재고가 부족합니다.'];
        }
        return ['success' => '재고가 충분합니다.'];
    }

}
