<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => strval($this->id),
            'type' => 'comment',
            'attributes' => [
                'comment' => $this->comment,

            ],
            'relationships' => [
                'blog' => ArticleResource::collection($this->articles)
            ]
            ];
    }
}
