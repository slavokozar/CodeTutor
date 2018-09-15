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
            'role' => UserRoles::ADMIN,
            'password' => bcrypt('secret')
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'surname' => 'Skoly',
            'email' => 'admin@codetutor.com',
            'birthdate' => '1993-01-28',
            'code' => 'a002',
            'password' => bcrypt('secret')
        ]);

        $ucitel = User::create([
            'name' => 'Ucitel',
            'surname' => 'Skoly',
            'email' => 'ucitel@codetutor.com',
            'birthdate' => '1994-06-24',
            'code' => 'a003',
            'password' => bcrypt('secret')
        ]);

        $autor = User::Create([
            'name' => 'Autor',
            'surname' => 'CodeLeague',
            'email' => 'autor@codetutor.com',
            'birthdate' => '1994-06-24',
            'code' => 'a004',
            'password' => bcrypt('secret')
        ]);

        $student = User::create([
            'name' => 'Student',
            'surname' => 'Skoly',
            'email' => 'student@codetutor.com',
            'birthdate' => '1994-06-24',
            'code' => 'a005',
            'password' => bcrypt('secret')
        ]);

        $codeleague = Group::create([
            'name' => 'CodeLeague',
            'code' => 'codeleague',
            'school_id' => null,
            'is_public' => true
        ]);

        Group::create([
            'name' => 'IV.B',
            'code' => 'ivb',
            'school_id' => null,
            'is_public' => true
        ]);

        $slavo->groups()->attach($codeleague, ['role' => GroupRoles::TEACHER]);
        $autor->groups()->attach($codeleague, ['role' => GroupRoles::TEACHER]);

        $faker = Faker::create();

        for($i = 0; $i < 2; $i++){

            $school = School::create([
                'name' => $faker->name,
                'code' => uniqid(),
                'address' => $faker->address,
                'url' => $faker->url
            ]);

            if($i == 0){
                $admin->schools()->attach($school, ['role' => SchoolRoles::ADMIN]);
            }elseif($i == 1){
                $ucitel->schools()->attach($school, ['role' => SchoolRoles::TEACHER]);
                $student->schools()->attach($school);
            }


            // create teachers
            for($j = 0; $j < 2; $j++){
                $teacher = User::create([
                    'title' => $faker->title,
                    'name' => $faker->firstName,
                    'surname' => $faker->lastName,
                    'email' => $faker->email,
                    'password' => bcrypt($faker->password),
                    'code' => uniqid(),
                    'birthdate' => $faker->date
                ]);

                $teacher->schools()->attach($school, ['role' => SchoolRoles::TEACHER]);
            }


            // create students
            for($j = 0; $j < 5; $j++){
                $student = User::create([
                    'name' => $faker->firstName,
                    'surname' => $faker->lastName,
                    'email' => $faker->email,
                    'password' => bcrypt($faker->password),
                    'code' => uniqid(),
                    'birthdate' => $faker->date
                ]);

                $student->schools()->attach($school, ['role' => SchoolRoles::STUDENT]);
            }

            // create students
            for($j = 0; $j < 3; $j++){
                $group = Group::create([
                    'name' => $faker->word,
                    'code' => uniqid(),
                    'school_id' => $school->id,
                    'is_public' => false
                ]);

                $slavo->groups()->attach($group, ['role' => GroupRoles::TEACHER]);
            }


        }

    }
}
