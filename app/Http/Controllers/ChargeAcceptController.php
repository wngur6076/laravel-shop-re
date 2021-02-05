<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChargeResource;
use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeAcceptController extends Controller
{
    public function __construct()
    {
        $this->middleware('isSuper');
    }

    public function index(Request $request)
    {
        $search_query = $request->input('searchTerm');
        $perPage = $request->input('per_page');

        $query = Charge::where('pin_number', 'LIKE', '%' . $search_query . '%');

        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        $query = $query->orderBy($sort, $order);

        $charges = $query->paginate($perPage);

        if ($search_query) {
			$searchTerm = $search_query ?: '';
		} else {
			$searchTerm = $search_query ? null : '';
        }

        return ChargeResource::collection($charges)->additional([
            'searchTerm' => $searchTerm,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'selectIds' => 'required|array',
        ]);

        $selectIds = $request->input('selectIds');

        $charges = Charge::whereIn('id', $selectIds);

        if (! $request->input('type')) {
            // 유저돈 충전하는 로직
            foreach ($charges->get() as $charge) {
                $user = $charge->user;
                $user->money += $charge->amount;
                $user->save();
            }
            $charges->delete();
            $message = '승인 성공했습니다.';
        } else {
            $charges->forceDelete();
            $message = '삭제 성공했습니다.';
        }

        return response()->json([
            'message' => $message,
            'selectIds' => $selectIds
        ], 200);
    }
}