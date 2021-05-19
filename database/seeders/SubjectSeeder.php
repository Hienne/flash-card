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
                'name' => 'Trường học',
                'description' => 'English A1 day 1'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 2,
                'name' => 'Nghề nghiệp',
                'description' => 'English A1 day 2'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'name' => 'Thể thao',
                'description' => ''
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 3,
                'name' => 'Thành phố',
                'description' => 'English A2 day 1'
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'name' => 'Cảm xúc',
                'description' => ''
            ],
        ]);
    }
}
