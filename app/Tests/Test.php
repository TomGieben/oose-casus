<?php

namespace App\Tests;

use App\EducationElements\Test;
use App\Models\TestCriteria;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfessionalProduct extends Test
{
    public function criteria(): HasMany
    {
        return $this->hasMany(TestCriteria::class);
    }
}