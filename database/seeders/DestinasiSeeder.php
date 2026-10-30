<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $initialDestinasi = [
            [
                'nama'        => 'Curug Malela',
                'deskripsi'   => 'Air terjun megah yang dijuluki sebagai The Little Niagara of West Java. Memiliki panorama tebing dan aliran air spektakuler yang dikelilingi hutan rimbun.',
                'lokasi'      => 'Desa Cicadas, Kec. Rongga, Gununghalu, Kabupaten Bandung Barat',
                'harga_tiket' => 15000,
                'gambar'      => 'curug.jpg',
            ],
            [
                'nama'        => 'Tangkuban Perahu',
                'deskripsi'   => 'Gunung stratovolcano aktif yang tersohor dengan legenda Sangkuriang. Wisatawan dapat menyaksikan keindahan Kawah Ratu dan Kawah Domas dari dekat.',
                'lokasi'      => 'Kecamatan Lembang, Kabupaten Bandung Barat',
                'harga_tiket' => 35000,
                'gambar'      => 'tangkuban.jpg',
            ],
            [
                'nama'        => 'Orchid Forest Cikole',
                'deskripsi'   => 'Taman konservasi anggrek terluas di Indonesia yang berada di tengah rimbunnya hutan pinus sejuk, dilengkapi jembatan kayu bercahaya di malam hari.',
                'lokasi'      => 'Genteng, Cikole, Kec. Lembang, Kabupaten Bandung Barat',
                'harga_tiket' => 50000,
                'gambar'      => 'orchid.png',
            ],
            [
                'nama'        => 'Farmhouse Susu Lembang',
                'deskripsi'   => 'Destinasi rekreasi bertema pedesaan Eropa lengkap dengan rumah hobbit, penyewaan kostum Belanda, dan wisata edukasi memberi makan hewan.',
                'lokasi'      => 'Jl. Raya Lembang No.108, Gudangkahuripan, Lembang, KBB',
                'harga_tiket' => 30000,
                'gambar'      => 'farmhouse.jpg',
            ],
            [
                'nama'        => 'Dusun Bambu Leisure Park',
                'deskripsi'   => 'Ekowisata terpadu di kaki Gunung Burangrang dengan pemandangan danau asri, saung Purbasari, dan berbagai restoran khas Sunda.',
                'lokasi'      => 'Jl. Kolonel Masturi KM. 11, Kertawangi, Kec. Cisarua, KBB',
                'harga_tiket' => 40000,
                'gambar'      => 'dusunbambu.jpg',
            ],
            [
                'nama'        => 'Floating Market Lembang',
                'deskripsi'   => 'Konsep wisata pasar apung di atas danau alami yang menyajikan aneka jajanan tradisional Sunda dengan transaksi menggunakan koin koin khusus.',
                'lokasi'      => 'Jl. Grand Hotel No.33E, Lembang, Kabupaten Bandung Barat',
                'harga_tiket' => 35000,
                'gambar'      => 'floating.png',
            ],
        ];

        foreach ($initialDestinasi as $data) {
            Destinasi::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }

        // Tambahan data dinamis menggunakan Faker
        $sampleImages = ['curug.jpg', 'tangkuban.jpg', 'orchid.png', 'farmhouse.jpg', 'dusunbambu.jpg', 'floating.png', 'ciremai.jpg', 'sumbingg.jpg'];
        $kbbDistricts = ['Lembang', 'Parongpong', 'Cisarua', 'Padalarang', 'Batujajar', 'Cililin', 'Cipatat', 'Cikalongwetan', 'Gununghalu'];

        for ($i = 1; $i <= 4; $i++) {
            $district = $faker->randomElement($kbbDistricts);
            $namaWisata = 'Wisata Panorama ' . $faker->colorName() . ' ' . $district;

            Destinasi::updateOrCreate(
                ['nama' => $namaWisata],
                [
                    'deskripsi'   => $faker->paragraph(3),
                    'lokasi'      => 'Kecamatan ' . $district . ', Kabupaten Bandung Barat',
                    'harga_tiket' => $faker->randomElement([10000, 15000, 20000, 25000, 30000, 50000]),
                    'gambar'      => $faker->randomElement($sampleImages),
                ]
            );
        }
    }
}
