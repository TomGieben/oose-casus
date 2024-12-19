<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name' => $this->name,
            'teacher' => new UserResource($this->teacher),
            'executions' => ExecutionResource::collection($this->executions),
            'resources' => ResourceResource::collection($this->resources),
            'plannings' => PlanningResource::collection($this->plannings),
            'learningObjectives' => LearningObjectiveResource::collection($this->learningObjectives),
        ];
    }
}
