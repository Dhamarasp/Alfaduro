<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $default_image = 'default.png';
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \DB::table('merek')->insert([
            ['namaMerek' => 'Indofood', 'gambarMerek' => $default_image],
            ['namaMerek' => 'ABC', 'gambarMerek' => $default_image],
            ['namaMerek' => 'Mayora', 'gambarMerek' => $default_image],
            ['namaMerek' => 'Sayap Mas Utama', 'gambarMerek' => $default_image],
        ]);

        // Categories
        \DB::table('kategori')->insert([
            ['namaKategori' => 'Makanan'],
            ['namaKategori' => 'Minuman'],
            ['namaKategori' => 'Sembako'],
            ['namaKategori' => 'Rokok'],
            ['namaKategori' => 'Pakaian'],
        ]);

        \DB::table('satuan')->insert([
            ['namaSatuan' => 'Kilogram'],
            ['namaSatuan' => 'Liter'],
            ['namaSatuan' => 'Biji'],
            ['namaSatuan' => 'Lusin'],
            ['namaSatuan' => 'Meter'],
        ]);

        \DB::table('layanan_pemesanan')->insert([
            ['jenisLayanan' => 'Kirim'],
            ['jenisLayanan' => 'COD'],
            ['jenisLayanan' => 'Transfer'],
            ['jenisLayanan' => 'Pre Order'],
        ]);

        \DB::table('jabatan')->insert([
            ['namaJabatan' => 'Manager', 'gaji'=> 2500000],
            ['namaJabatan' => 'Owner', 'gaji'=> 6500000],
            ['namaJabatan' => 'Staff', 'gaji'=> 9500000],
            ['namaJabatan' => 'Kasir', 'gaji'=> 4500000],
            ['namaJabatan' => 'Kurir', 'gaji'=> 7500000],
        ]);

        \DB::table('jenis_pembayaran')->insert([
            ['jenisPembayaran' => 'Tunai', 'kode'=> null, 'gambar' => null],
            ['jenisPembayaran' => 'Qris', 'kode'=> 'QQOE0QE2I0', 'gambar' => null],
            ['jenisPembayaran' => 'Dana', 'kode'=> 'D2RQF3WR3R', 'gambar' => null],
            ['jenisPembayaran' => 'Hutang', 'kode'=> null, 'gambar' => null],
            ['jenisPembayaran' => 'Pinjam 100', 'kode'=> null, 'gambar' => null],
        ]);

        \DB::table('supplier')->insert([
            ['namaSupplier' => 'PT Adi Guna', 'NoTeleponSupplier'=> '084536987452', 'alamatSupplier' => 'Jl. Ketitang'],
            ['namaSupplier' => 'UD Makmur', 'NoTeleponSupplier'=> '084513698745', 'alamatSupplier' => 'Jl. Simo'],
            ['namaSupplier' => 'Semoga Berkah UD', 'NoTeleponSupplier'=> '081236987456', 'alamatSupplier' => 'Jl. Waru'],
            ['namaSupplier' => 'PT Petean', 'NoTeleponSupplier'=> '081296328745', 'alamatSupplier' => 'Jl. Ngawi'],
            ['namaSupplier' => 'PT Sidomuncul', 'NoTeleponSupplier'=> '081245697845', 'alamatSupplier' => 'Jl. Jalan-jalan'],
        ]);

        \DB::table('pegawai')->insert([
            [
                'name' => 'Dhamar', 
                'email' => 'Dhamar Adhi', 
                'password' => bcrypt('123'), 
                'id_jabatan' => 2, 
                'noTelp' => '081234567890', 
                'alamat' => 'Jl. Mawar No. 123, Jakarta'
            ],
            [
                'name' => 'Jane Smith', 
                'email' => 'jane.smith@example.com', 
                'password' => bcrypt('123'), 
                'id_jabatan' => 1, 
                'noTelp' => '081298765432', 
                'alamat' => 'Jl. Melati No. 456, Bandung'
            ],
            [
                'name' => 'Michael Brown', 
                'email' => 'michael.brown@example.com', 
                'password' => bcrypt('123'), 
                'id_jabatan' => 3, 
                'noTelp' => '081356789012', 
                'alamat' => 'Jl. Anggrek No. 789, Surabaya'
            ],
            [
                'name' => 'Emily Johnson', 
                'email' => 'emily.johnson@example.com', 
                'password' => bcrypt('123'), 
                'id_jabatan' => 4, 
                'noTelp' => '081278901234', 
                'alamat' => 'Jl. Kenanga No. 101, Medan'
            ],
            [
                'name' => 'David Lee', 
                'email' => 'david.lee@example.com', 
                'password' => bcrypt('123'), 
                'id_jabatan' => 5, 
                'noTelp' => '081234890567', 
                'alamat' => 'Jl. Cemara No. 202, Makassar'
            ],
        ]);
        




    }
}
