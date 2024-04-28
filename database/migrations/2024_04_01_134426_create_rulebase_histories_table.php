<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Disease;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rulebase_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                // ->after('indikator_id')
                ->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Disease::class, 'disease_id')
                // ->after('indikator_id')
                ->nullable()->constrained('diseases')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('fuzzy_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulebase_histories');
    }
};
