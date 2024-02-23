<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddresseeList;

class AddresseeListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Your seeding logic here
        AddresseeList::factory()->count(50)->create();
    }
}