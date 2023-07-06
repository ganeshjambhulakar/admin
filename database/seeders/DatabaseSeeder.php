<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categery_master')->insert([
            ['name' => 'Mobile'],
            ['name' => 'Laptop'],
            ['name' => 'Watch'],
            ['name' => 'Bags'],
        ]);
    }
}
