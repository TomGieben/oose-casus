<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'test_id',
        'execution_id',
        'grade',
        'comment',
    ];

    protected $casts = [
        'grade' => 'float',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }   

    public function test(): BelongsTo
    {
        return $this->belongsTo(EducationElement::class, 'test_id');
    }

    public function execution(): BelongsTo
    {
        return $this->belongsTo(Execution::class);
    }
}
