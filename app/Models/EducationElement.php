<?php

namespace App\Models;

use App\EducationElements\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EducationElementType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function learningObjectives(): BelongsToMany
    {
        return $this->belongsToMany(
            LearningObjective::class,
            'education_element_learning_objective',
            'education_element_id',
            'learning_objective_id'
        );
    }

    public function getType(): EducationElement
    {
        return new $this->type_class->value;
    }

    public function isTest(): bool
    {
        $educationElement = $this->getType();
        return $educationElement instanceof Test;
    }
}
