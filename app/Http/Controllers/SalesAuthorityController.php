<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SalesAuthorityResource;

class SalesAuthorityController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->input('searchTerm');
        $perPage = $request->input('per_page');

        $query = User::select('users.*', \DB::raw('IFNULL(SUM(orders.total), 0) As purchase_amount'))
            ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.id');

        $query = $query->where('email', 'LIKE', '%' . $search_query . '%')->orWhere('name', 'LIKE', '%' . $search_query . '%');

        $sort = $request->input('sort', 'purchase_amount');
        $order = $request->input('order', 'desc');

        $query = $query->orderBy($sort, $order);
        if ($sort == 'role') {
            $temp = $order == 'desc' ? 'asc' : 'desc';
            $query->orderBy('credit', $order)->orderBy('id', $temp);
        }

        $users = $query->paginate($perPage);

        if ($search_query) {
			$searchTerm = $search_query ?: '';
		} else {
			$searchTerm = $search_query ? null : '';
        }

        return SalesAuthorityResource::collection($users)->additional([
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

        $user = User::whereIn('id', $selectIds);

        // 판매권환 승인, 기각
        foreach ($user->get() as $user) {
            if (! $request->input('type')) {
                $user->role = 2;
                $message = '승인 성공했습니다.';
            }
            else {
                $user->role = 1;
                $message = '기각 성공했습니다.';
            }
            $user->save();
        }

        return response()->json([
            'message' => $message,
            'selectIds' => $selectIds
        ], 200);
    }

    public function show(Request $request, User $user)
    {
        $search_query = $request->input('searchTerm');
        $perPage = $request->input('per_page');

        $query = $user->orders();
        $query = $query->where('title', 'LIKE', '%' . $search_query . '%');

        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        $query = $query->orderBy($sort, $order);

        $orders = $query->paginate($perPage);

        if ($search_query) {
			$searchTerm = $search_query ?: '';
		} else {
			$searchTerm = $search_query ? null : '';
        }

        return OrderResource::collection($orders)->additional([
            'searchTerm' => $searchTerm,
            'sort' => $sort,
            'order' => $order,
        ]);
    }
}
