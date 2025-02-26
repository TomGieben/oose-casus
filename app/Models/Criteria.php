<?php

namespace App\Models;

use App\Tests\ProfessionalProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function profesionalProducts(): BelongsToMany
    {
        return $this->belongsToMany(ProfessionalProduct::class);
    }

    public function getLimitedDescription(): string
    {
        return substr($this->description, 0, 30) . '...';
    }
}
