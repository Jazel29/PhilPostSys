<?php

namespace Database\Seeders;
use App\Models\Transmittals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmittalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate fake data for Transmittals
        Transmittals::factory()->count(50)->create();
    }

}
