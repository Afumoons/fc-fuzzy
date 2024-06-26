<?php

use App\Models\User;
use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rulebase_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                // ->after('indikator_id')
                ->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
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
