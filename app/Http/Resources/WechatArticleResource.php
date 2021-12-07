<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WechatArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'content' => $this->content ? $this->content->content : ''
        ];
    }
}
