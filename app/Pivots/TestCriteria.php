<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TestCriteria extends Pivot
{
    use HasFactory;

    protected $table = 'test_criteria';

    protected $fillable = [
        'test_id',
        'criteria_id',
    ];
}
