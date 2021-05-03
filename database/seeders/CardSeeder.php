<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 50; $i++) {
            DB::table('cards')->insert([
                'subject_id' => rand(1, 5),
                'front' => 'front of card '. $i,
                'back' => 'back of card '. $i,
                'num_of_study' => 0,
                'level_of_card' => 1,
                'expiry_date' => Carbon::now(),
            ]);
        }
    }
}
