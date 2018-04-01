<?php

use App\Classes\UserRoles;
use App\Classes\SchoolRoles;
use App\Classes\GroupRoles;

use App\Models\Users\Group;
use App\Models\Users\School;
use App\Models\Users\User;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $slavo = User::create([
            'name' => 'Slavomír',
            'surname' => 'Kožár',
            'email' => 'slavo.kozar@gmail.com',
            'birthdate' => '1993-03-24',
            'code' => 'a001',
            'role' => UserRoles::admin,
            'password' => bcrypt('asdf')
        ]);
//
//        $kamil = User::create([
//            'name' => 'Kamil',
//            'surname' => ' Triščík',
//            'email' => 'kamil.triscik@gmail.com',
//            'birthdate' => '1993-01-28',
//            'code' => 'a002',
//            'role' => UserRoles::admin,
//            'password' => bcrypt('secret')
//        ]);
//
//        $lukas = User::create([
//            'name' => 'Lukáš',
//            'surname' => 'Figura',
//            'email' => 'figurluk@gmail.com',
//            'birthdate' => '1994-06-24',
//            'code' => 'a003',
//            'role' => UserRoles::admin,
//            'password' => bcrypt('secret')
//        ]);
//
//
//        $codeleague = Group::create([
//            'name' => 'CodeLeague',
//            'code' => 'codeleague',
//            'school_id' => null,
//            'is_public' => true
//        ]);
//
//        $slavo->groups()->attach($codeleague, ['role' => GroupRoles::admin]);
//        $kamil->groups()->attach($codeleague, ['role' => GroupRoles::admin]);
//        $lukas->groups()->attach($codeleague, ['role' => GroupRoles::admin]);
//
//
//        $faker = Faker::create();
//
//        for($i = 0; $i < 2; $i++){
//
//            $school = School::create([
//                'name' => $faker->name,
//                'code' => uniqid(),
//                'address' => $faker->address,
//                'url' => $faker->url
//            ]);
//
//            // create teachers
//            for($j = 0; $j < 2; $j++){
//                $teacher = User::create([
//                    'title' => $faker->title,
//                    'name' => $faker->firstName,
//                    'surname' => $faker->lastName,
//                    'email' => $faker->email,
//                    'password' => bcrypt($faker->password),
//                    'code' => uniqid(),
//                    'birthdate' => $faker->date
//                ]);
//
//                $teacher->schools()->attach($school, ['role' => SchoolRoles::teacher]);
//            }
//
//
//            // create students
//            for($j = 0; $j < 5; $j++){
//                $student = User::create([
//                    'name' => $faker->firstName,
//                    'surname' => $faker->lastName,
//                    'email' => $faker->email,
//                    'password' => bcrypt($faker->password),
//                    'code' => uniqid(),
//                    'birthdate' => $faker->date
//                ]);
//
//                $student->schools()->attach($school, ['role' => SchoolRoles::student]);
//            }

//        }

    }
}
