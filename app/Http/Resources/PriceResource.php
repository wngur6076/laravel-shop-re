<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'period' => $this->period,
            'code' => $this->code,
            'price' => $this->price,
            'disabled' => $this->disabled,
            'code_quantity' => $this->code_quantity
        ];
    }
}