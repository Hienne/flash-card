<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [ 
                'user_id' => 1,
                'folder_id' => 2,
                'name' => 'subject 1',
                'description' => 'English A1 day 1'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 2,
                'name' => 'subject 2',
                'description' => ''
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'name' => 'subject 3',
                'description' => 'no folder'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 3,
                'name' => 'subject 4',
                'description' => 'English A2 day 1'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'name' => 'subject 5',
                'description' => ''
            ],
        ]);
    }
}
