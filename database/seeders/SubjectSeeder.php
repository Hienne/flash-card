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
                'maker' => 'hien99',
                'name' => 'Trường học',
                'description' => 'English A1 day 1',
                'shared_status' => true,
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 2,
                'maker' => 'hien99',
                'name' => 'Nghề nghiệp',
                'description' => 'English A1 day 2',
                'shared_status' => true,
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'maker' => 'hien99',
                'name' => 'Thể thao',
                'description' => '',
                'shared_status' => true,
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 3,
                'maker' => 'hien99',
                'name' => 'Thành phố',
                'description' => 'English A2 day 1',
                'shared_status' => true,
            ],
            [ 
                'user_id' => 1,
                'folder_id' => 1,
                'maker' => 'hien99',
                'name' => 'Cảm xúc',
                'description' => '',
                'shared_status' => true,
            ],
        ]);
    }
}
