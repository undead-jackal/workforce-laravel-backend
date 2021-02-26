<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user_freelancers')->insert([
        //     [
        //         'fname' => 'John',
        //         'lname' => 'Doe',
        //         'level'=>0,
        //         'credential'=>1
        //     ],
        //     [
        //         'fname' => 'Alex',
        //         'lname' => 'Mercer',
        //         'level'=>1,
        //         'credential'=>4
        //     ],
        //     [
        //         'fname' => 'Vicktor',
        //         'lname' => 'Reznov',
        //         'level'=>2,
        //         'credential'=>5
        //     ],
        //     [
        //         'fname' => 'Mason',
        //         'lname' => 'White',
        //         'level'=>3,
        //         'credential'=>6
        //     ],
        // ]);

        // DB::table('user_coordinator')->insert([
        //     [
        //         'fname' => 'Jack',
        //         'lname' => 'Sparrow',
        //         'credential'=>2
        //     ],
        //     [
        //         'fname' => 'Eddie',
        //         'lname' => 'Murphey',
        //         'credential'=>7
        //     ],
        //     [
        //         'fname' => 'James',
        //         'lname' => 'Menerva',
        //         'credential'=>8
        //     ],
        //     [
        //         'fname' => 'Ray',
        //         'lname' => 'Mama',
        //         'credential'=>9
        //     ],
        // ]);

        DB::table('hired_job')->insert([
            [
                'freelancer' => json_encode(array('28')),
                'job' => 8,
            ],
        ]);
    }
}
