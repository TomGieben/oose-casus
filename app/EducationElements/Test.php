<?php

namespace App\EducationElements;

use App\Models\EducationElement;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Test extends EducationElement
{
    public function evalluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    public function areLearningObjectivesCovered(Collection $objectives): bool
    {
        $testObjectives = $this->learningObjectives;

        foreach ($testObjectives as $testObjective) {
            if (!$objectives->contains($testObjective)) {
                return false;
            }
        }

        return true;
    }
}
