<?php

use App\Models\EducationElement;
use App\Models\LearningObjective;
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
        Schema::create('education_element_learning_objective', function (Blueprint $table) {
            $table->foreignIdFor(EducationElement::class)->constrained('education_elements', 'id', 'education_element_foreign');
            $table->foreignIdFor(LearningObjective::class)->constrained('learning_objectives', 'id', 'learning_objective_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_element_learning_objectives');
    }
};
