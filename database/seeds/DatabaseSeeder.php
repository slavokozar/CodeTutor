<?php

use App\Models\Article;
use App\Models\Assignment;
use App\Models\Group;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voidd
     */
    public function run()
    {

//        $rules = Article::create([
//            'name' => 'Pravidlá',
//            'code' => 'rules_sk',
//            'is_public' => false,
//            'author_id' => $admin->id,
//            'series_id' => null,
//            'series_order' => null,
//
//            'description' => '',
//            'text' => ''
//        ]);

        $this->call(UserSeeder::class);


//        $this->call(ProgrammingLanguagesSeeder::class);

    }
}
