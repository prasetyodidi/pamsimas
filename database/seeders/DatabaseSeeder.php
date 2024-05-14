<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // User::factory(10)->create();

        // $roleAdmin = Role::factory()->create([
        //     'name' => 'admin',
        // ]);

        // $rolePelanggan = Role::factory()->create([
        //     'name' => 'pelanggan',
        // ]);

        $admin1 = User::factory()->create([
            'name' => 'Admin Satu',
            'username' => 'admin1',
            'email' => 'admin@gmail.com',
            // 'role_id' => $roleAdmin->id
        ]);

        $pelanggan1 = User::factory()->create([
            'name' => 'Pelanggan Satu',
            'username' => 'pelanggan1',
            'email' => 'pelanggan@gmail.com',
            // 'role_id' => $rolePelanggan->id
        ]);
    }
}
