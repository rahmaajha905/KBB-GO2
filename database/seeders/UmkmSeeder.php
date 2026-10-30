<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $initialUmkm = [
            [
                'nama'      => 'Keripik Singkong & Tempe Lembang',
                'kategori'  => 'Kuliner & Camilan',
                'deskripsi' => 'Keripik renyah olahan singkong dan kedelai pilihan petani lokal dengan bumbu rempah khas Priangan tanpa bahan pengawet.',
                'alamat'    => 'Jl. Maribaya No. 12, Lembang, Kabupaten Bandung Barat',
                'gambar'    => 'kripik.jpg',
            ],
            [
                'nama'      => 'Kopi Java Preanger Gununghalu',
                'kategori'  => 'Minuman & Kopi',
                'deskripsi' => 'Kopi Arabika premium dengan aroma floral dan cita rasa buah khas lereng pegunungan Bandung Barat yang telah memenangkan penghargaan rasa tingkat internasional.',
                'alamat'    => 'Desa Sirnajaya, Kec. Gununghalu, Kabupaten Bandung Barat',
                'gambar'    => 'kopi.png',
            ],
            [
                'nama'      => 'Batik Tulis Karst Padalarang',
                'kategori'  => 'Fashion & Kerajinan',
                'deskripsi' => 'Kain batik khas Bandung Barat dengan motif karst Citatah, daun teh, dan flora pegunungan bernilai seni tinggi karya pembatik lokal.',
                'alamat'    => 'Jl. Kertajaya No. 88, Padalarang, Kabupaten Bandung Barat',
                'gambar'    => 'batik2.png',
            ],
            [
                'nama'      => 'Anyaman Bambu Kreatif Cisarua',
                'kategori'  => 'Kerajinan Tangan',
                'deskripsi' => 'Produk perabot dan dekorasi rumah ramah lingkungan dari bambu wulung pilihan karya kelompok pengrajin tradisional Cisarua.',
                'alamat'    => 'Desa Kertawangi, Kec. Cisarua, Kabupaten Bandung Barat',
                'gambar'    => 'anyaman.jpg',
            ],
            [
                'nama'      => 'Wayang Golek Tradisional Parongpong',
                'kategori'  => 'Seni & Budaya',
                'deskripsi' => 'Pahat boneka kayu wayang golek bernuansa tokoh pewayangan Sunda seperti Cepot dan Gatotkaca buatan tangan seniman Parongpong.',
                'alamat'    => 'Jl. Cihanjuang KM. 4, Parongpong, Kabupaten Bandung Barat',
                'gambar'    => 'wayang.jpg',
            ],
            [
                'nama'      => 'Bakpia & Kue Kering Cihampelas',
                'kategori'  => 'Kuliner & Camilan',
                'deskripsi' => 'Aneka bakpia lembut isi kacang hijau, keju, dan cokelat lumer serta olahan kue basah khas oleh-oleh Bandung Barat.',
                'alamat'    => 'Jl. Raya Cihampelas No. 23, Kabupaten Bandung Barat',
                'gambar'    => 'bakpia.jpg',
            ],
        ];

        foreach ($initialUmkm as $data) {
            Umkm::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }

        // Tambahan data dinamis menggunakan Faker
        $sampleImages = ['kripik.jpg', 'kopi.png', 'batik2.png', 'anyaman.jpg', 'wayang.jpg', 'bakpia.jpg', 'kuliner.jpg'];
        $categories = ['Kuliner & Camilan', 'Minuman & Kopi', 'Fashion & Kerajinan', 'Kerajinan Tangan', 'Pertanian & Olahan'];
        $districts = ['Lembang', 'Cisarua', 'Parongpong', 'Batujajar', 'Padalarang', 'Cililin', 'Cikalongwetan'];

        for ($i = 1; $i <= 4; $i++) {
            $cat = $faker->randomElement($categories);
            $dist = $faker->randomElement($districts);
            $nama = 'UMKM ' . $faker->company() . ' ' . $dist;

            Umkm::updateOrCreate(
                ['nama' => $nama],
                [
                    'kategori'  => $cat,
                    'deskripsi' => $faker->paragraph(2),
                    'alamat'    => 'Jl. ' . $faker->streetName() . ' No. ' . $faker->buildingNumber() . ', Kec. ' . $dist . ', KBB',
                    'gambar'    => $faker->randomElement($sampleImages),
                ]
            );
        }
    }
}
