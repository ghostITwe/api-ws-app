<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'likes' => $this->likes,
//            'comments' => $this->comments,
            'created_at' => $this->created_at,
//            'team' => $this->team,
            'gallery' => ImageResource::collection($this->gallery),

        ];
    }
}
