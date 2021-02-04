<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function store(Request $request)
    {
        if (! $request->input('type')) {
            $request->validate([
                'pin_number' => 'required|string',
                'amount' => 'required|int',
                'type' => 'required|boolean',
            ]);
            $data = $request->user()->charges()->create($request->all());
        } else {
            $request->validate([
                'pinList' => 'required|array',
                'pinList.*.number.*' => 'required|digits_between:4,6',
                'pinList.*.amount' => 'required|int',
                'type' => 'required|boolean',
            ]);
            $pinList = [];
            foreach ($request->input('pinList') as $i => $pin) {
                $pinList[$i]['type'] = $request->input('type');
                $pinList[$i]['amount'] = $pin['amount'];
                $pinList[$i]['pin_number'] = '';
                foreach ($pin['number'] as $number) {
                    $pinList[$i]['pin_number'] .= $number;
                }
            }
            $data = $request->user()->charges()->createMany($pinList);
        }

        return response()->json([
            'message' => '요청 성공했습니다.',
            'data' => $data
        ], 200);
    }
}