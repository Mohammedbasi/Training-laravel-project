<?php

namespace UserModule\database\seeders;

use Illuminate\Database\Seeder;
use UserModule\App\Models\User;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        User::factory(50)->create();
    }
}
