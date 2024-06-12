<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\FuzzyRule;
use App\Models\FuzzyTemp;
use App\Models\FuzzyUserInput;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\UpdateFuzzyRuleRequest;

class FuzzyController extends Controller
{
    public $statementArray = ['Sedikit', 'Sedang', 'Banyak'];

    function saveRuleAttributes($symptoms, $statements, Disease $disease): void
    {
        $huruf = [];
        $angka = [];
        $symptomTotal = count($symptoms);
        $statementTotal = count($statements);
        foreach ($symptoms as $key => $symptom) {
            $huruf[$key + 1] = $symptom;
        }
        foreach ($statements as $key => $statement) {
            $angka[$key + 1] = $statement;
        }
        $temp = [];
        for ($ctemp = 1; $ctemp <= $symptomTotal; $ctemp++) {
            $temp[$ctemp] = 1;
        }

        while ($temp[1] <= $statementTotal) {
            $churuf = 0;
            $data = [];
            $dataAntecedent = [];
            $dataConsequent = [];
            $tingkatKeparahan = 0;
            // atur nilai maks 90
            $nilaiBanyak = (90) / $symptomTotal;
            $nilaiSedang = (90) / $symptomTotal / $statementTotal * 2;
            $nilaiSedikit = (90) / $symptomTotal / $statementTotal;
            while ($churuf < $symptomTotal) {
                $churuf++;
                $index = $temp[$churuf];
                $dataAntecedent[$huruf[$churuf]] = $angka[$index];
                if ($angka[$index] == "Sedikit") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedikit;
                } else if ($angka[$index] == "Sedang") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedang;
                } else if ($angka[$index] == "Banyak") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiBanyak;
                }
            }
            $dataConsequent['Diagnosis'] = $disease->code;
            $dataConsequent['TingkatKeparahan'] = $tingkatKeparahan;
            $data['antecedent'] = $dataAntecedent;
            $data['consequent'] = $dataConsequent;

            FuzzyRule::create([
                'disease_id' => $disease->id,
                'data' => $data,
            ]);

            $temp[$symptomTotal] = $temp[$symptomTotal] + 1;
            $ctemp = $symptomTotal;
            while ($ctemp != 1) {
                if ($temp[$ctemp] > $statementTotal) {
                    $temp[$ctemp] = 1;
                    $temp[$ctemp - 1] = $temp[$ctemp - 1] + 1;
                }
                $ctemp = $ctemp - 1;
            }
        }
    }

    function doFuzzy(Disease $disease, FuzzyTemp $fuzzyTemp)
    {
        $rulebases = $disease->rulebases()->where('value', true)->get();
        $symptomsArray = $fuzzyTemp->symptom_data;
        $membershipFunctionArray = $fuzzyTemp->membership_data;

        // Data penyakit dan gejala (dibaca dari database)
        $penyakit = [
            "P1" => [
                "gejala" => $symptomsArray,
                "fungsiKeanggotaan" => $membershipFunctionArray,
                "aturan" => $disease->fuzzyRules->pluck('data')
            ],
            // fuzzy sebenarnya bisa untuk diagnosis penyakit
            // tanpa forward chaining dengan menambahkan
            // P2, P3 dan sebagainya
        ];

        $inputPasien = [];
        foreach (FuzzyUserInput::IsOwned()->IsNotDone()->get() as $key => $fuzzyUserInput) {
            if ($fuzzyUserInput->value == "Sedikit") {
                $value = 0.5;
            } else if ($fuzzyUserInput->value == "Sedang") {
                $value = 1;
            } else if ($fuzzyUserInput->value == "Banyak") {
                $value = 1.5;
            }
            $inputPasien[$fuzzyUserInput->symptom_id] = $value;
        }

        // Jika InputPasien atau FuzzyUserInput tidak ada
        if (empty($inputPasien)) {
            return null;
        }

        // Evaluasi aturan Fuzzy Sugeno
        $aktivasiAturan = [];
        foreach ($penyakit as $namaPenyakit => $dataPenyakit) {
            $aktivasiAturan[$namaPenyakit] = [];
            foreach ($dataPenyakit["aturan"] as $aturan) {
                $derajatAktivasi = 1.0;
                foreach ($aturan["antecedent"] as $gejala => $kategori) {
                    $derajatKeanggotaanGejala = $this->derajatKeanggotaan(
                        $inputPasien[$gejala],
                        $dataPenyakit["fungsiKeanggotaan"][$gejala],
                        $kategori
                    );
                    $derajatAktivasi = min($derajatAktivasi, $derajatKeanggotaanGejala);
                }
                // dd($derajatKeanggotaanGejala, $derajatAktivasi);
                $aktivasiAturan[$namaPenyakit][] = $derajatAktivasi * $aturan["consequent"]["TingkatKeparahan"];
            }
        }

        // Agregasi dan defuzzifikasi
        $diagnosis = "";
        $tingkatKeparahanTertinggi = 0.0;
        foreach ($aktivasiAturan as $namaPenyakit => $aktivasiPenyakit) {
            $totalAktivasi = 0.0;
            $bobotTotal = 0.0;
            foreach ($aktivasiPenyakit as $aktivasiAturan2) {
                $totalAktivasi += $aktivasiAturan2;
                $bobotTotal += 1.0;
            }

            if ($bobotTotal > 0.0) {
                $tingkatKeparahan = $totalAktivasi / $bobotTotal;
                if ($tingkatKeparahan > $tingkatKeparahanTertinggi) {
                    $diagnosis = $namaPenyakit;
                    $tingkatKeparahanTertinggi = $tingkatKeparahan;
                }
            }
        }
        $tingkatKeparahanTertinggi = $tingkatKeparahanTertinggi * $bobotTotal;

        // dd($this->getAttribute(['G1', 'G2'], ['Sedikit', 'Sedang', 'Banyak']));

        // Hasil diagnosis
        return $tingkatKeparahanTertinggi ?? 0;
    }

    /**
     * This function calculates the membership degree.
     * @param float $nilai The input value.
     * @param array $fungsiKeanggotaan The membership function.
     * @param string $kategori The category of the input value.
     * @return float The membership degree.
     */
    function derajatKeanggotaan($nilai, $fungsiKeanggotaan, $kategori)
    {
        if ($kategori == "Sedikit") {
            list($a1, $a2, $a3) = $fungsiKeanggotaan[$kategori];
            if ($nilai < $a1) { // $nilai < 0
                return 1.0;
            } else if ($nilai <= $a2) { // $nilai <= 0.5
                // 1.0 - $nilai / 1.0 - 0.5
                return ($a3 - $nilai) / ($a3 - $a2);
            } else {
                return 0.0;
            }
        } else if ($kategori == "Sedang") {
            list($a1, $a2, $a3) = $fungsiKeanggotaan[$kategori];
            if ($nilai < $a1) { // $nilai < 0.5
                return 0.0;
            } else if ($nilai <= $a2) { // $nilai <= 1.0
                // ($nilai - 0.5) / (1.0 - 0.5)
                return ($nilai - $a1) / ($a2 - $a1);
            } else {
                // (1.5 - $nilai) / (1.5 - 1.0)
                return ($a3 - $nilai) / ($a3 - $a2);
            }
        } else if ($kategori == "Banyak") {
            list($a1, $a2, $a3) = $fungsiKeanggotaan[$kategori];
            if ($nilai < $a1) { // $nilai < 1.0
                return 0.0;
            } else if ($nilai <= $a2) { // $nilai <= 1.5
                // ($nilai - 1.0) / (1.5 - 1.0)
                return ($nilai - $a1) / ($a2 - $a1);
            } else if ($nilai <= $a3) { // $nilai <= 2
                return 1.0;
            } else {
                return 0.0;
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::with('fuzzyRules')->get();
        // dd($diseases);
        return Inertia::render('Admin/Fuzzy/Index', (new AdminController)->getViewData([
            'diseases' => $diseases,
        ]));
    }

    /**
     * Show the list for displaying the specified fuzzy rule resource.
     */
    public function show(Disease $disease)
    {
        $disease = Disease::with('fuzzyRules')->findOrFail($disease->id)->toArray();

        $antecedentArray = [];
        foreach ($disease['fuzzy_rules'] as $key => $fuzzyRule) {
            foreach ($fuzzyRule['data']['antecedent'] as $index => $value) {
                $symptom = Symptom::findOrFail($index);
                $antecedentArray[$symptom->code . ' ' . $symptom->name] =   ' -> ' . $value;
            }
            $disease['fuzzy_rules'][$key]['data']['antecedent'] = $antecedentArray;
        }

        return Inertia::render('Admin/Fuzzy/Show', (new AdminController)->getViewData([
            'isAdmin' => Gate::allows('isAdmin'),
            'disease' => $disease,
        ]));
    }

    public function edit(FuzzyRule $fuzzyRule)
    {
        $fuzzyRule = FuzzyRule::findOrFail($fuzzyRule->id)->toArray();

        $antecedentArray = [];
        foreach ($fuzzyRule['data']['antecedent'] as $index => $value) {
            $symptom = Symptom::findOrFail($index);
            $antecedentArray[$symptom->code . ' ' . $symptom->name] =   ' -> ' . $value;
        }
        $fuzzyRule['data']['antecedent'] = $antecedentArray;

        // dd($fuzzyRule->data);
        return Inertia::render('Admin/Fuzzy/Edit', (new AdminController)->getViewData([
            'isAdmin' => Gate::allows('isAdmin'),
            'fuzzyRule' => $fuzzyRule,
        ]));
    }

    public function update(UpdateFuzzyRuleRequest $request, FuzzyRule $fuzzyRule)
    {

        $validatedData = $request->validated();
        $dataArray = $fuzzyRule->data;
        $dataArray['consequent']['TingkatKeparahan'] = $validatedData['result'];
        $fuzzyRule->data = $dataArray;
        $fuzzyRule->update($validatedData);

        return to_route('admin.fuzzy.show', $fuzzyRule->disease);
    }
}
