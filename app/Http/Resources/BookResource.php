<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'author_id' => $this->whenLoaded('author', function($author){
                return $author->name. " ".$author->last_name;
            }),
            'title' => $this->title,
            'description' => $this->description,
            'published_year' => $this->published_year,
            'genres' => $this->whenLoaded('genres', function(){
                return $this->genres->pluck('name');    
            }),
            'stock' => $this->whenCounted('copies')
        ];
    }
}
