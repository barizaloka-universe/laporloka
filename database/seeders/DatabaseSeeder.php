<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Database\Seeders\SpatieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Laporan::factory(50)->create();
        $this->call(SpatieSeeder::class);

        $user = User::factory()->admin()->create();
        $user->assignRole('admin');
    }
}
