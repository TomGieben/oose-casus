<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupStudent extends Pivot
{
    use HasFactory;

    protected $table = 'group_student';

    protected $fillable = [
        'group_id',
        'student_id',
    ];
}
