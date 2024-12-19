<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanningResource extends JsonResource
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
            'educationElement' => new EducationElementResource($this->educationElement),
            'week' => $this->week->value,
            'day' => $this->day->value,
            'startsAt' => $this->starts_at->format('H:i'),
            'endsAt' => $this->ends_at->format('H:i'),
        ];
    }
}
