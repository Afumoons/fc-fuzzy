<?php

namespace App\Http\Controllers\Admin;

use App\Models\Disease;
use App\Models\FuzzyRule;
use App\Models\FuzzyTemp;
use App\Models\FuzzyUserInput;
use App\Http\Controllers\Controller;

class FuzzyController extends Controller
{
    public $statementArray = ['Sedikit', 'Sedang', 'Banyak'];

    private function getAttributes($hurufs, $angkas)
    {
        $huruf = [];
        $angka = [];
        $totalHuruf = count($hurufs);
        $totalAngka = count($angkas);
        foreach ($hurufs as $key => $hurufArg) {
            $huruf[$key + 1] = $hurufArg;
        }
        foreach ($angkas as $key => $angkaArg) {
            $angka[$key + 1] = $angkaArg;
        }
        $temp = [];
        for ($ctemp = 1; $ctemp <= $totalHuruf; $ctemp++) {
            $temp[$ctemp] = 1;
        }
        // dd($temp);

        $dataPembungkus = [];
        $countDataPembungkus = 0;
        while ($temp[1] <= $totalAngka) {
            $churuf = 0;
            $data = [];
            while ($churuf < $totalHuruf) {
                $churuf++;
                $duar = $temp[$churuf];

                // echo "$huruf[$churuf]";
                // echo " => ";
                // echo "$angka[$duar]";
                // echo "\n";
                $data[$huruf[$churuf]] = $angka[$duar];
            }
            // echo " <br> ";
            $dataPembungkus[$countDataPembungkus] = $data;
            $countDataPembungkus++;

            $temp[$totalHuruf] = $temp[$totalHuruf] + 1;
            $ctemp = $totalHuruf;
            // dd($temp, $ctemp);
            while ($ctemp != 1) {
                if ($temp[$ctemp] > $totalAngka) {
                    $temp[$ctemp] = 1;
                    $temp[$ctemp - 1] = $temp[$ctemp - 1] + 1;
                }
                $ctemp = $ctemp - 1;
            }
        }
        return $dataPembungkus;
    }

    private function getRuleAttributes($symptoms, $statements, $disease)
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
        // dd($temp);

        $dataPembungkus = [];
        $countDataPembungkus = 0;
        while ($temp[1] <= $statementTotal) {
            $churuf = 0;
            $data = [];
            $dataAntecedent = [];
            $dataConsequent = [];
            $tingkatKeparahan = 0;
            $nilaiBanyak = (90) / $symptomTotal;
            $nilaiSedang = (90) / $symptomTotal / $statementTotal * 2;
            $nilaiSedikit = (90) / $symptomTotal / $statementTotal;
            while ($churuf < $symptomTotal) {
                $churuf++;
                $duar = $temp[$churuf];

                // echo "$huruf[$churuf]";
                // echo " => ";
                // echo "$angka[$duar]";
                // echo "\n";
                $dataAntecedent[$huruf[$churuf]] = $angka[$duar];
                if ($angka[$duar] == "Sedikit") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedikit;
                } else if ($angka[$duar] == "Sedang") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedang;
                } else if ($angka[$duar] == "Banyak") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiBanyak;
                }
                // dd($angka[$duar], $tingkatKeparahan);
            }
            // dd($nilaiBanyak, $nilaiSedang, $nilaiSedikit);
            $dataConsequent['Diagnosis'] = $disease;
            $dataConsequent['TingkatKeparahan'] = $tingkatKeparahan;
            $data['antecedent'] = $dataAntecedent;
            $data['consequent'] = $dataConsequent;
            // echo " <br> ";
            $dataPembungkus[$countDataPembungkus] = $data;
            $countDataPembungkus++;

            $temp[$symptomTotal] = $temp[$symptomTotal] + 1;
            $ctemp = $symptomTotal;
            // dd($temp, $ctemp);
            while ($ctemp != 1) {
                if ($temp[$ctemp] > $statementTotal) {
                    $temp[$ctemp] = 1;
                    $temp[$ctemp - 1] = $temp[$ctemp - 1] + 1;
                }
                $ctemp = $ctemp - 1;
            }
        }
        return $dataPembungkus;
    }

    function saveRuleAttributes($symptoms, $statements, Disease $disease): void
    {
        // dd($symptoms, $statements, $fuzzyTemp);
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
        // dd($temp);

        while ($temp[1] <= $statementTotal) {
            $churuf = 0;
            $data = [];
            $dataAntecedent = [];
            $dataConsequent = [];
            $tingkatKeparahan = 0;
            $nilaiBanyak = (90) / $symptomTotal;
            $nilaiSedang = (90) / $symptomTotal / $statementTotal * 2;
            $nilaiSedikit = (90) / $symptomTotal / $statementTotal;
            while ($churuf < $symptomTotal) {
                $churuf++;
                $duar = $temp[$churuf];

                // echo "$huruf[$churuf]";
                // echo " => ";
                // echo "$angka[$duar]";
                // echo "\n";
                $dataAntecedent[$huruf[$churuf]] = $angka[$duar];
                if ($angka[$duar] == "Sedikit") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedikit;
                } else if ($angka[$duar] == "Sedang") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiSedang;
                } else if ($angka[$duar] == "Banyak") {
                    $tingkatKeparahan = $tingkatKeparahan + $nilaiBanyak;
                }
                // dd($angka[$duar], $tingkatKeparahan);
            }
            // dd($nilaiBanyak, $nilaiSedang, $nilaiSedikit);
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
            // dd($temp, $ctemp);
            while ($ctemp != 1) {
                if ($temp[$ctemp] > $statementTotal) {
                    $temp[$ctemp] = 1;
                    $temp[$ctemp - 1] = $temp[$ctemp - 1] + 1;
                }
                $ctemp = $ctemp - 1;
            }
        }
    }

    function index()
    {
        $disease = Disease::first();
        $rulebases = $disease->rulebases()->where('value', true)->get();
        $symptomsArray = [];
        $membershipFunctionArray = [];
        $statementsArray = ['Sedikit', 'Sedang', 'Banyak'];
        foreach ($rulebases as $rulebaseKey => $rulebase) {
            $angka = 0.0;
            $angka2 = 0.5;
            $angka3 = 1.0;
            $symptomsArray[$rulebaseKey] = $rulebase->symptom->code;
            foreach ($statementsArray as  $statement) {
                $membershipFunctionArray[$rulebase->symptom->code][$statement] = [$angka, $angka2, $angka3];
                $angka = $angka + 0.5;
                $angka2 = $angka2 + 0.5;
                $angka3 = $angka3 + 0.5;
            }
        }
        // Data penyakit dan gejala (dibaca dari database)
        $penyakit = [
            "P1" => [
                "gejala" => $symptomsArray,
                "fungsiKeanggotaan" => $membershipFunctionArray,
                "aturan" => $this->getRuleAttributes($symptomsArray, $statementsArray, $rulebases[0]->disease->code)
            ],
        ];

        // Input dari pasien (diperoleh dari formulir web)
        $inputPasien = [
            "G1" => 1.5,
            "G2" => 1.5,
            "G3" => 1.5,
            "G4" => 1.5,
            "G5" => 1.5,
            "G6" => 1.5,
            "G7" => 1.5,
        ];

        // Evaluasi aturan Fuzzy Sugeno
        $aktivasiAturan = [];
        foreach ($penyakit as $namaPenyakit => $dataPenyakit) {
            $aktivasiAturan[$namaPenyakit] = [];
            foreach ($dataPenyakit["aturan"] as $aturan) {
                $derajatAktivasi = 1.0;
                foreach ($aturan["antecedent"] as $gejala => $kategori) {
                    $derajatKeanggotaanGejala = $this->derajatKeanggotaan($inputPasien[$gejala], $dataPenyakit["fungsiKeanggotaan"][$gejala], $kategori);
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
        if ($diagnosis != "") {
            echo "Diagnosis: $diagnosis\n";
            echo "Tingkat Keparahan: $tingkatKeparahanTertinggi\n";
        } else {
            echo "Diagnosis tidak dapat ditentukan.\n";
        }
        dd($penyakit);
    }

    function doFuzzy(Disease $disease, FuzzyTemp $fuzzyTemp)
    {
        // dd($disease, $fuzzyTemp);
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
}

