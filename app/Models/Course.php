<?php

namespace App\Models;

use App\Enums\Status;
use App\Pivots\CourseLearningObjective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'status',
        'name',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function executions(): HasMany
    {
        return $this->hasMany(Execution::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function plannings(): HasMany
    {
        return $this->hasMany(Planning::class);
    }

    public function learningObjectives(): HasManyThrough
    {
        return $this->hasManyThrough(LearningObjective::class, CourseLearningObjective::class);
    }

    public function getPlanningsInOrder(): Collection
    {
        return $this->plannings()->orderBy('week')->orderBy('day')->orderBy('starts_at')->get();
    }

    public function isDraft(): bool
    {
        return $this->status->is(Status::Draft);
    }

    public function isPlannable(): bool
    {
        return $this->status->is(Status::Plannable);
    }

    public function verifyCompletion(): bool
    {
        $totalLearningObjectives = collect();

        if (!$this->checkLearningObjectivesPlanning($totalLearningObjectives)) {
            $this->update(['status' => Status::Draft]);
            return false;
        }


        if (!$this->areLearningObjectivesCovered($totalLearningObjectives)) {
            $this->update(['status' => Status::Draft]);
            return false;
        }

        $this->update(['status' => Status::Plannable]);
        return true;
    }

    private function checkLearningObjectivesPlanning(Collection &$totalLearningObjectives): bool
    {
        $plannings = $this->getPlanningsInOrder();

        $learningObjectivesBeforeTest = collect();
        foreach ($plannings as $planning) {
            $educationElement = $planning->educationElement;

            if (!$educationElement->isTest()) {
                $learningObjectivesBeforeTest = $learningObjectivesBeforeTest->merge($educationElement->learningObjectives);
                continue;
            }

            $totalLearningObjectives = $totalLearningObjectives->merge($learningObjectivesBeforeTest);

            $isCovered = $educationElement->areLearningObjectivesCovered($learningObjectivesBeforeTest);
            $learningObjectivesBeforeTest = collect();

            if (!$isCovered) {
                return false;
            }
        }

        return true;
    }

    public function areLearningObjectivesCovered(Collection $objectives): bool
    {
        $courseObjectives = $this->learningObjectives;

        foreach ($courseObjectives as $courseObjective) {
            if (!$objectives->contains($courseObjective)) {
                return false;
            }
        }

        return true;
    }
}
