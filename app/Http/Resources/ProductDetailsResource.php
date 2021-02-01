<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'body_html' => $this->body_html,
            'body' => $this->body,
            'image' => $this->image_url,
            'image_name' => $this->image,
            'video' => $this->video_url,
            'video_name' => $this->video,
            'created_date' => $this->created_date,
            'file_link' => $this->file_link,
            'tags' => TagResource::collection($this->tags),
            'code_list' => CodeResource::collection($this->codeList)
        ];
    }
}