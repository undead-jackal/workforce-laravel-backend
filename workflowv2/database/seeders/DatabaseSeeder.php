<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credentials')->insert([
            // [
            //     'username' => 'freelancer',
            //     'password' => Hash::make('password'),
            //     'type' => 0,
            // ],[
            //     'username' => 'coordinator',
            //     'password' => Hash::make('password'),
            //     'type' => 1,
            // ],[
            //     'username' => 'employer',
            //     'password' => Hash::make('password'),
            //     'type' => 2,
            // ]
            // [
            //     'username' => 'freelancer2',
            //     'password' => Hash::make('password'),
            //     'type' => 0,
            // ],[
            //     'username' => 'freelancer3',
            //     'password' => Hash::make('password'),
            //     'type' => 0,
            // ],[
            //     'username' => 'freelancer3',
            //     'password' => Hash::make('password'),
            //     'type' => 0,
            // ],[
            //     'username' => 'coordinator2',
            //     'password' => Hash::make('password'),
            //     'type' => 1,
            // ],[
            //     'username' => 'coordinator3',
            //     'password' => Hash::make('password'),
            //     'type' => 1,
            // ],[
            //     'username' => 'coordinator4',
            //     'password' => Hash::make('password'),
            //     'type' => 1,
            // ]
        ]);

        DB::table('job')->insert([
            
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
