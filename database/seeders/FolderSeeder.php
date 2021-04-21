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
                'name' => 'folder 1',
                'description' => 'English A1',
            ],
            [ 
                'user_id' => 1,
                'name' => 'folder 3',
                'description' => 'English B2',
            ],
        ]);
    }
}
