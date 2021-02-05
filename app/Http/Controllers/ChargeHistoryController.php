<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;
use App\Http\Resources\ChargeResource;

class ChargeHistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $search_query = $request->input('searchTerm');
        $perPage = $request->input('per_page');

        $query = $request->user()->charges()->withTrashed();

        $query = $query->where('pin_number', 'LIKE', '%' . $search_query . '%');

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
}