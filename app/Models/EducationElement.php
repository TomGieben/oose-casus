<?php

namespace App\Models;

use App\EducationElements\Test;
use App\Pivots\EducationElementLearningObjective;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Enums\EducationElementType;

class EducationElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_class',
        'name',
        'description',
    ];

    protected $casts = [
        'type_class' => EducationElementType::class,
    ];

    public function learningObjectives(): HasManyThrough
    {
        return $this->hasManyThrough(LearningObjective::class, EducationElementLearningObjective::class);
    }

    public function getType(): EducationElement
    {
        return new $this->type_class;
    }

    public function isTest(): bool
    {
        $educationElement = $this->getType();
        return $educationElement instanceof Test;
    }
}