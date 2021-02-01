<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
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

        $selectOptions = collect();
        $selectIds = $request->input('selectIds');

        foreach ($selectIds as $i => $selectId) {
            $selectOptions->push(Code::find($selectId));
            $selectOptions[$i]->purchaseQuantity = $request->input('quantityList')[$i];
            $maxQuantityList[] = $product->getCodeQuantity($selectOptions[$i]->period);
        }

        $totalPrice = $this->totalPrice($selectOptions);

        // 구매금액이 유저money 보다 크면 403반환
        if ($totalPrice > auth()->user()->money)
            return response()->json(['error' => '충전금이 부족합니다.'], 403);

        // 재고가 있는지 체크하는 함수
        $message = $this->inventoryManagement($selectOptions->pluck('purchaseQuantity'), $maxQuantityList);
        if (isset($message['error']))
            return response()->json($message, 403);

        // 돈을 지불힘수: 사용자 money업데이트
        $this->payment($totalPrice);

        // 구매개수랑 현재보유코드개수랑 같을경우 전체를 다 가져오고 아닐경우에는 Disabled = true만 가져온다. (false는 기준값)
        foreach ($selectOptions as $i => $option) {
            if ($maxQuantityList[$i] == $option->purchaseQuantity) {
                $codeList[] = $product->getCodeList($option->period, 0, $option->purchaseQuantity);
            } else {
                $codeList[] = $product->getCodeList($option->period, 1, $option->purchaseQuantity);
            }
        }

        return response()->json([
            'totalPrice' => $codeList
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'product' => new PaymentResource($product)
        ], 200);
    }

    public function payment($totalPrice)
    {
        $user = User::find(auth()->user()->id);
        $user->money = $user->money - $totalPrice;
        $user->save();
    }

    public function totalPrice($selectOptions)
    {
        $result = 0;
        foreach ($selectOptions as $option) {
            $result += $option->price * $option->purchaseQuantity;
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
