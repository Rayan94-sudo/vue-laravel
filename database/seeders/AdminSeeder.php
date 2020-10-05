<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // modify to following commands fit your table structure
         $user = User::create(['email' => 'your@email.com', 'password' => bcrypt('secret'),'role' => 'admin']);
      
    }
}
