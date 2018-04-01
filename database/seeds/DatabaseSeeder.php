<?php


use App\Classes\UserRoles;
use App\Models\Users\User;
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




        $this->call(UserSeeder::class);


//        $this->call(ProgrammingLanguagesSeeder::class);

    }
}
