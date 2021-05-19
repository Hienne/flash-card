<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folders')->insert([
            [ 
                'user_id' => 1,
                'name' => 'Default',
                'description' => 'Default Folder',
            ],
            [ 
                'user_id' => 1,
                'name' => 'English A1',
                'description' => 'vocabulary for A1 level',
            ],
            [ 
                'user_id' => 1,
                'name' => 'English A2',
                'description' => 'vocabulary for A2 level',
            ],
        ]);
    }
}
