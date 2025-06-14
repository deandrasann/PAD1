<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            KlinikSeeder::class,
            AdminSeeder::class,
            DokterSeeder::class,
            ApotekerSeeder::class,
            PasienSeeder::class,
            ObatSeeder::class,
            PengawasSeeder::class,
            // PemeriksaanSeeder::class,
            // ResepSeeder::class,
            // DetailResepSeeder::class,
            ResepsionisSeeder::class,
            IcdSeeder::class
        ]);
    }
}
