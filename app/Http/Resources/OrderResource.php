<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $maxQuantityList = [];
        $codeList = CodeResource::collection($this->payment_option);
        foreach ($codeList as $code) {
            $maxQuantityList[] = $this->getCodeQuantity($code->period);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'code_list' => $codeList,
            'max_quantity_list' => $maxQuantityList,
        ];
    }
}
