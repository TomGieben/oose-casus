<?php

namespace App\Pivots;

use App\Models\EducationElement;
use App\Models\LearningObjective;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EducationElementLearningObjective extends Pivot
{
    use HasFactory;

    protected $table = 'education_element_learning_objective';

    protected $fillable = [
        'education_element_id',
        'learning_objective_id',
    ];

    public function educationElement()
    {
        return $this->belongsTo(EducationElement::class);
    }

    public function learningObjective()
    {
        return $this->belongsTo(LearningObjective::class);
    }
}
