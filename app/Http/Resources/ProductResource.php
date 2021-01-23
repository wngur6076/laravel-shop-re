<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'price' => $this->price,
            'image' => $this->image_url,
            'video' => $this->video_Url,
            'created_date' => $this->created_date,
            'user' => new UserResource($this->user),
            'tags' => TagResource::collection($this->tags)
        ];
    }
}