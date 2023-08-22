<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\City;
use App\Models\Country;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use UserModule\App\Models\User;
use UserModule\Database\Seeders\NewUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',]);

        //User::factory(500)->create();
        //Vendor::factory(10)->create();
        //Country::factory(5)->create();
        //City::factory(10)->create();
        Brand::factory(20)->create();
//        $this->call(NewUserSeeder::class);
    }
}
