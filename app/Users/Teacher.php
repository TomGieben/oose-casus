<?php

namespace App\Users;

use App\Models\Course;
use App\Models\Execution;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends User
{
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function executions(): HasMany
    {
        return $this->hasMany(Execution::class, 'teacher_id');
    }
}
