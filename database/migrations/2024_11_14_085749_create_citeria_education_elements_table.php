<?php

use App\Models\Criteria;
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
        Schema::create('test_criteria', function (Blueprint $table) {
            $table->foreignIdFor(Criteria::class)->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->constrained('education_elements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citeria_test');
    }
};
