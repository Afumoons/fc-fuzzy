<?php

use App\Models\User;
use App\Models\Symptom;
use App\Models\RulebaseHistory;
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
        Schema::create('fuzzy_user_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                // ->after('indikator_id')
                ->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Symptom::class, 'symptom_id')
                // ->after('indikator_id')
                ->nullable()->constrained('symptoms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(RulebaseHistory::class, 'rulebase_history_id')
                // ->after('indikator_id')
                ->nullable()->constrained('rulebase_histories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_user_inputs');
    }
};
