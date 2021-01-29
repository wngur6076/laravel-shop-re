<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
        $priceList = PriceResource::collection($this->payment_option);
        foreach ($priceList as $price) {
            $maxQuantityList[] = $this->getCodeQuantity($price->period);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price_list' => $priceList,
            'max_quantity_list' => $maxQuantityList,
        ];
    }
}