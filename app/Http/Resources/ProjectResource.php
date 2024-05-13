<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->nome,
            'description' => $this->description,
            'img' => $this->img,
            'user_id' => $this->user_id,
            'url' => route('projects.show', $this->id)
        ];
    }
}
