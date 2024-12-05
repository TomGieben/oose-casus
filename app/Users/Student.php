<?php

namespace App\Users;

use App\Models\Evaluation;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends User
{
    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'student_id');
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'student_id');
    }

    public function addToGroup(Group $group): void
    {
        $this->groups()->save($group);
    }

    public function exitGroup(Group $group): void
    {
        $this->groups()->detach($group);
    }

    public function addEvaluation(Evaluation $evaluation): void
    {
        $this->evaluations()->save($evaluation);
    }
}
