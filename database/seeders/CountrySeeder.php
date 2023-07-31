<?php

namespace Database\Seeders;

use App\Models\Address\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $country = new Country();
            $country->name = fake()->country();
        
    
            $country->save();
        }
    }
}
