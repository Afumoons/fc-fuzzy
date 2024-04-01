<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Symptom;
use App\Models\Disease;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rulebase_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Disease::class, 'disease_id')
                // ->after('indikator_id')
                ->nullable()->constrained('diseases')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Symptom::class, 'symptom_id')
                // ->after('indikator_id')
                ->nullable()->constrained('symptoms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('value')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulebase_temps');
    }
};
