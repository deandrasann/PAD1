<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = collect([
            [
                'id_admin' => '1',
                'id_pengguna' => '1',
                'id_klinik' => '1',
                'nama_admin' => 'adminpenjaga',
                'email' => 'admin@gmail.com',
                'foto' => 'ror',
            ]
        ]);

        $admin->each(fn ($put) => DB::table('admin')->insert($put));

    }
}
