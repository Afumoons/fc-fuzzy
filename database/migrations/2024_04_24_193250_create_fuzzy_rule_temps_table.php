<?php

use App\Models\User;
use App\Models\Disease;
use App\Models\FuzzyTemp;
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
        Schema::create('fuzzy_rule_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                // ->after('indikator_id')
                ->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(FuzzyTemp::class, 'fuzzy_temp_id')
                // ->after('indikator_id')
                ->nullable()->constrained('fuzzy_temps')->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_rule_temps');
    }
};
