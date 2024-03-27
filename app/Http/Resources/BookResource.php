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
            'author' => $this->whenLoaded('author', $this->author->name." ".$this->author->last_name),
            'title' => $this->title,
            'description' => $this->description,
            'published_year' => $this->published_year,
            'genres' => $this->genres->pluck('name'),
            'copies' => $this->when($this->copies_count, $this->copies_count)
        ];
    }
}
