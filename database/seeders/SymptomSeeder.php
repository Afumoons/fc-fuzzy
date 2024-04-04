<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Symptom::create([
            'code' => 'G1',
            'name' => 'Komedo terbuka (white head) dan tertutup (black head)'
        ]);
        Symptom::create([
            'code' => 'G2',
            'name' => 'Terdapat Tonjolan/Benjolan'
        ]);
        Symptom::create([
            'code' => 'G3',
            'name' => 'Benjolan Kemerahan (Papul)'
        ]);
        Symptom::create([
            'code' => 'G4',
            'name' => 'Benjolan Berisi Nanah (Pustul)'
        ]);
        Symptom::create([
            'code' => 'G5',
            'name' => 'Benjolan Keras Dibawah Permukaan Kulit (Nodul)'
        ]);
        Symptom::create([
            'code' => 'G6',
            'name' => 'Benjolan Besar Dibawah Permukaan Kulit Berisi Cairan (Kista)'
        ]);
        Symptom::create([
            'code' => 'G7',
            'name' => 'Terasa gatal'
        ]);
        Symptom::create([
            'code' => 'G8',
            'name' => 'Bintik-bintik (Vesikel atau Bula)'
        ]);
        Symptom::create([
            'code' => 'G9',
            'name' => 'bintik-bintik yang tersebar secara terpisah'
        ]);
        Symptom::create([
            'code' => 'G10',
            'name' => 'Kulit berkerak berlapis-lapis (Krusta)'
        ]);
        Symptom::create([
            'code' => 'G11',
            'name' => 'Daerah permukaan yang mengeluarkan cairan'
        ]);
        Symptom::create([
            'code' => 'G12',
            'name' => 'Riwayat gigitan serangga sebelumnya'
        ]);
        Symptom::create([
            'code' => 'G13',
            'name' => 'Bintik hitam rata'
        ]);
        Symptom::create([
            'code' => 'G14',
            'name' => 'Ukuran bintik hitam membesar'
        ]);
        Symptom::create([
            'code' => 'G15',
            'name' => 'Luka berwarna coklat kehitaman'
        ]);
        Symptom::create([
            'code' => 'G16',
            'name' => 'Luka berwarna coklat'
        ]);
        Symptom::create([
            'code' => 'G17',
            'name' => 'Luka berambut'
        ]);
        Symptom::create([
            'code' => 'G18',
            'name' => 'Luka dengan tangkai'
        ]);
        Symptom::create([
            'code' => 'G19',
            'name' => 'Suhu badan meninggi'
        ]);
        Symptom::create([
            'code' => 'G20',
            'name' => 'Ruam merah'
        ]);
        Symptom::create([
            'code' => 'G21',
            'name' => 'Kulit kering, pecah-pecah, atau bersisik'
        ]);
        Symptom::create([
            'code' => 'G22',
            'name' => 'Nyeri atau rasa terbakar pada kulit'
        ]);
        Symptom::create([
            'code' => 'G23',
            'name' => 'Pembengkakan atau bengkak pada kulit'
        ]);
        Symptom::create([
            'code' => 'G24',
            'name' => 'Ruam berbentuk lingkaran atau bulatan'
        ]);
        Symptom::create([
            'code' => 'G25',
            'name' => 'Kulit mengelupas'
        ]);
        Symptom::create([
            'code' => 'G26',
            'name' => 'Bercak-bercak coklat'
        ]);
        Symptom::create([
            'code' => 'G27',
            'name' => 'Bercak-bercak abu-abu gelap'
        ]);
        Symptom::create([
            'code' => 'G28',
            'name' => 'Muncul di area yang terpapar sinar matahari'
        ]);
        Symptom::create([
            'code' => 'G29',
            'name' => 'Gatal yang intens pada berbagai bagian tubuh'
        ]);
    }
}
