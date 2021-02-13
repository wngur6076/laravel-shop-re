<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesAuthorityResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'money' => number_format($this->money),
            'purchase_amount' => number_format($this->purchase_amount) ?: 0,
            'credit' => $this->credit_convert,
        ];
    }
}
