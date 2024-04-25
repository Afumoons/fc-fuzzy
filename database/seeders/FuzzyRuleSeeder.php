<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;
use App\Http\Controllers\Admin\FuzzyController;

class FuzzyRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Disease::get() as $disease) {
            (new FuzzyController)->saveRuleAttributes($disease->rulebases()->where('value', true)->get()->pluck('symptom_id'), (new FuzzyController)->statementArray, $disease);
        }
    }
}
