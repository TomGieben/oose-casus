<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExecutionResource extends JsonResource
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
            'date' => $this->date->format('Y-m-d H:i'),
            'name' => $this->name,
            'group' => new GroupResource($this->group),
            'teacher' => new UserResource($this->teacher),
            'classroom' => new ClassroomResource($this->classroom),
        ];
    }
}
