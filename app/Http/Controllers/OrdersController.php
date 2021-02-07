<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\CodeDetailsResource;

class OrdersController extends Controller
{
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'selectIds' => 'required|array',
            'quantityList' => 'required|array',
        ]);

        $selectOptions = collect();
        $selectIds = $request->input('selectIds');
        $maxQuantityList = [];

        foreach ($selectIds as $i => $selectId) {
            $selectOptions->push(Code::find($selectId));
            $selectOptions[$i]->quantity = $request->input('quantityList')[$i];
            $maxQuantityList[] = $product->getCodeQuantity($selectOptions[$i]->period);
        }

        $total = $this->totalPrice($selectOptions);

        // 구매금액이 유저money 보다 크면 403반환
        if ($total > auth()->user()->money)
            return response()->json(['error' => '충전금이 부족합니다.'], 403);

        // 재고가 있는지 체크하는 함수
        $message = $this->inventoryManagement($selectOptions->pluck('quantity'), $maxQuantityList);
        if (isset($message['error']))
            return response()->json($message, 403);

        $hash = bin2hex(random_bytes(32));
        $order = $request->user()->orders()->create([
            'hash' => $hash,
            'title' => $product->title,
            'total' => $total,
            'file_link' => $product->file_link,
        ]);

        // 유저돈에서 total만큼 차감
        $order->payment();

        // 구매개수랑 현재보유코드개수랑 같을경우 전체를 다 가져오고 아닐경우에는 Disabled = true만 가져온다. (false는 기준값)
        $codeList = [];
        foreach ($selectOptions as $i => $option) {
            if ($maxQuantityList[$i] == $option->quantity) {
                $codeList[$i] = $product->getCodeList($option->period, 0, $option->quantity);
            } else {
                $codeList[$i] = $product->getCodeList($option->period, 1, $option->quantity);
            }
            $order->codeList()->attach($codeList[$i]);
            foreach ($codeList[$i] as $code) {
                $code->delete();
            }
        }

        return response()->json([
            'message' => '결제 성공했습니다.',
            'total' => $total
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'product' => new CodeDetailsResource($product)
        ], 200);
    }

    public function totalPrice($selectOptions)
    {
        $result = 0;
        foreach ($selectOptions as $option) {
            $result += $option->price * $option->quantity;
        }
        return $result;
    }

    public function inventoryManagement($quantityList, $maxQuantityList)
    {
        foreach ($quantityList as $i => $quantity) {
            if ($quantity < 1 )
                return ['error' => '수량을 정확하게 입력하세요.'];
            else if ($maxQuantityList[$i] < $quantity)
                return ['error' => '재고가 부족합니다.'];
        }
        return ['success' => '재고가 충분합니다.'];
    }
}