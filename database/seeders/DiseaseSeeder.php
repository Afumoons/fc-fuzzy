<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Disease::create([
            'code' => 'P1',
            'name' => 'Acne Vulgaris',
            'cause' => "Jerawat biasanya muncul karena pori-pori kulit tersumbat oleh minyak dan kotoran, serta bakteri yang menyebabkan peradangan.",
            'solution' => 'Cuci wajah Anda secara teratur dengan pembersih wajah yang lembut.
            Gunakan pelembap yang ringan dan tidak mengandung minyak.
            Jangan memencet jerawat, karena bisa membuatnya lebih parah.
            Hindari produk-produk perawatan kulit yang terlalu berminyak.
            Jika jerawat Anda parah, Anda bisa mencoba produk perawatan yang mengandung bahan aktif seperti benzoyl peroxide atau salicylic acid. Jika tidak membaik, konsultasikan dengan dokter.',
        ]);
        Disease::create([
            'code' => 'P2',
            'name' => 'Pioderma',
            'cause' => "Pioderma adalah infeksi bakteri pada kulit yang disebabkan oleh bakteri jahat yang bisa hidup di kulit kita.",
            'solution' => 'Jaga kebersihan kulit dengan rajin mandi dan membersihkan area yang terinfeksi.
            Hindari menggaruk area yang terinfeksi, karena bisa membuatnya lebih parah.
            Gunakan salep antibiotik jika terdapat di apotek, tapi jika tidak membaik, lebih baik pergi ke dokter.',
        ]);
        Disease::create([
            'code' => 'P3',
            'name' => 'Skabies',
            'cause' => "Skabies disebabkan oleh tungau kecil yang bisa hidup di kulit kita.",
            'solution' => 'Pastikan semua anggota keluarga atau orang yang dekat dengan Anda ikut diobati, meskipun mereka tidak memiliki gejala.
            Cuci pakaian, handuk, dan seprai dengan air panas untuk membunuh tungau yang mungkin ada di sana.
            Jangan berdekatan terlalu erat dengan orang yang terinfeksi, karena bisa menular.
            Gunakan krim yang diresepkan oleh dokter untuk mengobati skabies, dan pastikan untuk membersihkan rumah Anda dengan baik.',
        ]);
        Disease::create([
            'code' => 'P4',
            'name' => 'Tinea Urtikaria',
            'cause' => "Tinea urtikaria adalah kondisi di mana kulit Anda mengalami reaksi alergi terhadap infeksi jamur, yang sering kali muncul sebagai bercak merah yang gatal.",
            'solution' => 'Hindari menggaruk area yang terkena, karena bisa memperburuk gatal dan menyebabkan infeksi.
            Oleskan salep atau krim antihistamin yang tersedia di apotek untuk membantu mengurangi rasa gatal.
            Jika bercak merah dan gatal tidak membaik dalam beberapa hari, atau jika Anda memiliki gejala lain seperti demam atau pembengkakan, segera konsultasikan dengan dokter.',
        ]);
        Disease::create([
            'code' => 'P5',
            'name' => 'Tumor Jinak Kulit (Nevus Pigmentosus)',
            'cause' => 'Nevus pigmentosus adalah pertumbuhan kulit yang umumnya tidak berbahaya dan seringkali disebut sebagai tahi lalat atau bintik hitam pada kulit.',
            'solution' => 'Pantau perubahan pada nevus pigmentosus, seperti perubahan warna, ukuran, atau bentuk.
            Jika Anda melihat perubahan yang mencurigakan pada nevus, segera konsultasikan dengan dokter untuk evaluasi lebih lanjut.',
        ]);
        Disease::create([
            'code' => 'P6',
            'name' => 'Drug Eruption',
            'cause' => 'Drug eruption adalah reaksi alergi kulit terhadap obat atau zat tertentu, yang dapat menyebabkan ruam, gatal, atau kemerahan pada kulit.',
            'solution' => 'Hentikan penggunaan obat yang diduga menyebabkan reaksi alergi kulit.
            Oleskan salep atau krim antihistamin untuk membantu mengurangi gatal dan kemerahan.
            Jika reaksi alergi kulit parah atau tidak membaik setelah beberapa hari, segera hubungi dokter untuk saran lebih lanjut.',
        ]);
        Disease::create([
            'code' => 'P7',
            'name' => 'Dermatitis',
            'cause' => 'Dermatitis adalah peradangan pada kulit yang bisa disebabkan oleh berbagai hal, seperti alergi, iritasi, atau kontak dengan zat tertentu.',
            'solution' => 'Hindari faktor pemicu yang mungkin menyebabkan dermatitis, seperti deterjen yang keras, sabun, atau produk perawatan kulit tertentu.
            Gunakan krim atau salep pelembap yang cocok untuk kulit sensitif.
            Jika dermatitis parah atau tidak membaik setelah beberapa hari, konsultasikan dengan dokter untuk perawatan lebih lanjut.',
        ]);
        Disease::create([
            'code' => 'P8',
            'name' => 'Melasma',
            'cause' => 'Melasma adalah kondisi di mana kulit wajah mengalami hiperpigmentasi, seringkali disebabkan oleh paparan sinar matahari, perubahan hormon, atau faktor genetik.',
            'solution' => 'Gunakan tabir surya setiap hari untuk melindungi kulit dari paparan sinar matahari.
            Gunakan krim pemutih yang mengandung bahan aktif seperti hydroquinone atau kojic acid, sesuai saran dokter.
            Hindari paparan sinar matahari secara berlebihan, terutama pada jam-jam terik.',
        ]);
        Disease::create([
            'code' => 'P9',
            'name' => 'Pruritus DM',
            'cause' => 'Pruritus DM adalah kondisi di mana penderita diabetes mengalami gatal-gatal pada kulit sebagai komplikasi dari penyakit diabetes.',
            'solution' => 'Jaga kadar gula darah Anda tetap terkontrol dengan mengikuti rencana perawatan yang telah ditentukan dokter.
            Gunakan pelembap yang cocok untuk kulit kering dan gatal.
            Hindari menggaruk kulit yang gatal, karena bisa menyebabkan iritasi dan infeksi.
            Jika gatal terus berlanjut atau menjadi lebih parah, segera konsultasikan dengan dokter untuk evaluasi lebih lanjut.',
        ]);
    }
}
