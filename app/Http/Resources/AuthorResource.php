<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = "Author";

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->last_name,
            'country' => $this->country->name
        ];
    }
}
