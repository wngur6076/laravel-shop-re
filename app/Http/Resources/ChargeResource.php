<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargeResource extends JsonResource
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
            'pin_number' => $this->pin,
            'amount' => $this->amount_convert,
            'type' => $this->type_name,
            'created_at' => $this->created_date,
            'accept' => $this->accept
        ];
    }
}