<?php

namespace App\Models;

use App\EducationElements\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TestCriteria extends Pivot
{
    use HasFactory;

    protected $table = 'test_criteria';

    protected $fillable = [
        'test_id',
        'criteria_id',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
