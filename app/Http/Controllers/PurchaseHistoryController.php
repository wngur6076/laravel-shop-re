<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $search_query = $request->input('searchTerm');
        $perPage = $request->input('per_page');

        $query = $request->user()->orders();

        $query = $query->where('total', 'LIKE', '%' . $search_query . '%');

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