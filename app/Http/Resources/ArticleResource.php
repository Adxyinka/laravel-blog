<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => strval($this->id),
            'type'=> 'article_post',
             'attributes' => [
                'title' => $this->title,
                'body' => $this->body,
                'author'=> $this->author

             ],
             'relationships' => [
                'category' => 
                [
                    'category_id' => strval($this->category->id),
                     'title' => $this->category->title
                ]
                ],
                'comment' => [
                    'id' => strval($this->category->id),
                    'comment' => $this->comment->comment
                ]
        ];
    }
}
