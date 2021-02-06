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
        $product = $this->codeList()->withTrashed()->first()->product;
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'product' => $product->title,
            'total' => $this->total_convert,
            'created_at' => $this->created_date,
            'file_link' => $product->file_link
        ];
    }
}