<?php

namespace App\Http\Resources;

use App\Models\Category;
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
            'title'=>$this->title,
            'body'=>$this->body,
            'category' => new CategoryResorce($this->category),
            'owner'=> new UserResource($this->user),
        ];
        
    }
}
