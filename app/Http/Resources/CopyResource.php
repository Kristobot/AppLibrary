<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CopyResource extends JsonResource
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
            'book' => $this->whenLoaded('book', function(){
                return $this->book->title;
            }),
            'copy_status' => $this->whenLoaded('status', function(){
                return $this->status->name;
            })
        ];
    }
}
