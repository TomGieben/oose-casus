<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
    ];

    public function executions(): HasMany
    {
        return $this->hasMany(Execution::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
