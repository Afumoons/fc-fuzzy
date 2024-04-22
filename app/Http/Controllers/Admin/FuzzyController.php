<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FuzzyController extends Controller
{
    function index()
    {
        // Data penyakit dan gejala (dibaca dari database)
        $penyakit = [
            "P1" => [
                "gejala" => ["G1", "G2"],
                "fungsiKeanggotaan" => [
                    "G1" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ],
                    "G2" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ],
                ],
                "aturan" => [
                    [
                        "antecedent" => ["G1" => "Sedikit", "G2" => "Sedikit"],
                        "consequent" => ["Diagnosis" => "P1", "TingkatKeparahan" => 0.25]
                    ],
                    [
                        "antecedent" => ["G1" => "Sedang", "G2" => "Sedang"],
                        "consequent" => ["Diagnosis" => "P1", "TingkatKeparahan" => 0.5]
                    ],
                    [
                        "antecedent" => ["G1" => "Banyak", "G2" => "Banyak"],
                        "consequent" => ["Diagnosis" => "P1", "TingkatKeparahan" => 1.0]
                    ]
                ]
            ],
            "P2" => [
                "gejala" => ["G2", "G3"],
                "fungsiKeanggotaan" => [
                    "G2" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ],
                    "G3" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ]
                ],
                "aturan" => [
                    [
                        "antecedent" => ["G2" => "Sedikit", "G3" => "Sedikit"],
                        "consequent" => ["Diagnosis" => "P2", "TingkatKeparahan" => 0.25]
                    ],
                    [
                        "antecedent" => ["G2" => "Sedang", "G3" => "Sedang"],
                        "consequent" => ["Diagnosis" => "P2", "TingkatKeparahan" => 0.5]
                    ],
                    [
                        "antecedent" => ["G2" => "Banyak", "G3" => "Banyak"],
                        "consequent" => ["Diagnosis" => "P2", "TingkatKeparahan" => 1.0]
                    ]
                ]
            ],
            "P3" => [
                "gejala" => ["G1", "G3"],
                "fungsiKeanggotaan" => [
                    "G1" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ],
                    "G3" => [
                        "Sedikit" => [0.5, 1.0, 1.5],
                        "Sedang" => [1.0, 1.5, 2.0],
                        "Banyak" => [1.5, 2.0, 2.5],
                    ]
                ],
                "aturan" => [
                    [
                        "antecedent" => ["G3" => "Sedikit", "G3" => "Sedikit"],
                        "consequent" => ["Diagnosis" => "P3", "TingkatKeparahan" => 0.25]
                    ],
                    [
                        "antecedent" => ["G3" => "Sedang", "G3" => "Sedang"],
                        "consequent" => ["Diagnosis" => "P3", "TingkatKeparahan" => 0.5]
                    ],
                    [
                        "antecedent" => ["G3" => "Banyak", "G3" => "Banyak"],
                        "consequent" => ["Diagnosis" => "P3", "TingkatKeparahan" => 1.0]
                    ]
                ]
            ],
        ];

        // Input dari pasien (diperoleh dari formulir web)
        $inputPasien = [
            "G1" => 1.5,
            "G2" => 1.5,
            "G3" => 0.5,
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
                $aktivasiAturan[$namaPenyakit][] = $derajatAktivasi * $aturan["consequent"]["TingkatKeparahan"];
            }
        }

        // Agregasi dan defuzzifikasi
        $diagnosis = "";
        $tingkatKeparahanTertinggi = 0.0;
        foreach ($aktivasiAturan as $namaPenyakit => $aktivasiPenyakit) {
            $totalAktivasi = 0.0;
            $bobotTotal = 0.0;
            foreach ($aktivasiPenyakit as $aktivasiAturan) {
                $totalAktivasi += $aktivasiAturan;
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

        // dd($this->getAttribute(['G1', 'G2'], ['Sedikit', 'Sedang', 'Banyak']));

        // Hasil diagnosis
        if ($diagnosis != "") {
            echo "Diagnosis: $diagnosis\n";
            echo "Tingkat Keparahan: $tingkatKeparahanTertinggi\n";
        } else {
            echo "Diagnosis tidak dapat ditentukan.\n";
        }
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
            if ($nilai < $a1) {
                return 1.0;
            } else if ($nilai <= $a2) {
                return ($a3 - $nilai) / ($a3 - $a2);
            } else {
                return 0.0;
            }
        } else if ($kategori == "Sedang") {
            list($a1, $a2, $a3) = $fungsiKeanggotaan[$kategori];
            if ($nilai < $a1) {
                return 0.0;
            } else if ($nilai <= $a2) {
                return ($nilai - $a1) / ($a2 - $a1);
            } else {
                return ($a3 - $nilai) / ($a3 - $a2);
            }
        } else if ($kategori == "Banyak") {
            list($a1, $a2, $a3) = $fungsiKeanggotaan[$kategori];
            if ($nilai < $a1) {
                return 0.0;
            } else if ($nilai <= $a2) {
                return ($nilai - $a1) / ($a2 - $a1);
            } else if ($nilai <= $a3) {
                return 1.0;
            } else {
                return 0.0;
            }
        }
    }
}
