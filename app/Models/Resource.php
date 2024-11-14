<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'education_element_id',
        'name',
        'content',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function educationElement(): BelongsTo
    {
        return $this->belongsTo(EducationElement::class);
    }
}
