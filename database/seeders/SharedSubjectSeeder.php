<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SharedSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shared_subjects')->insert([
            [ 
                'subject_id' => 1,
                'name' => 'Trường học',
            ],
            [ 
                'subject_id' => 2,
                'name' => 'Nghề nghiệp',
            ],
            [ 
                'subject_id' => 3,
                'name' => 'Thể thao',
            ],
            [ 
                'subject_id' => 4,
                'name' => 'Thành phố',
            ],
            [ 
                'subject_id' => 5,
                'name' => 'Cảm xúc',
            ],
        ]);
    }
}
