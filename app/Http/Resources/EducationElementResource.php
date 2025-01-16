<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationElementResource extends JsonResource
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
            'type' => $this->type_class->label(),
            'name' => $this->name,
            'description' => $this->description,
            'learningObjectives' => LearningObjectiveResource::collection($this->learningObjectives),
        ];
    }
}
