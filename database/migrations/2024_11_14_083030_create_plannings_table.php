<?php

use App\Models\Course;
use App\Models\EducationElement;
use App\Models\Resource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->constrained();
            $table->foreignIdFor(EducationElement::class)->constrained();
            $table->integer('week');
            $table->integer('day');
            $table->time('starts_at');
            $table->time('ends_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};
