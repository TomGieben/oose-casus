<?php

namespace App\Models;

use App\Enums\Day;
use App\Enums\Week;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'education_element_id',
        'week',
        'day',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'week' => Week::class,
        'day' => Day::class,
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
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
