<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesDetailsResource extends JsonResource
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
            'purchaser' => $this->orders()->first()->user->name,
            'code' => $this->code,
            'price' => number_format($this->price),
            'deleted_at' => $this->deleted_date,
        ];
    }
}