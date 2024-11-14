<?php

namespace App\Models;

use App\Enums\Status;
use App\Pivots\EducationElementLearningObjective;
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

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function executions(): HasMany
    {
        return $this->hasMany(Execution::class);
    }
}
