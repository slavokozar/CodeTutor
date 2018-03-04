<?php

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Seeder;

class ProgrammingLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'code' => 'c',
                'name' => 'C'
            ],
            [
                'code' => 'cpp',
                'name' => 'C++'
            ],
            [
                'code' => 'java',
                'name' => 'Java'
            ]
        ];


        foreach($languages as $laguage){
            ProgrammingLanguage::create($laguage);
        }


    }
}
