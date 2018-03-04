<?php

use App\Models\Assignment;
use App\Models\AssignmentSolution;

use App\Models\Group;
use App\Models\School;
use App\Models\User;

use Illuminate\Database\Seeder;

class TestAssignmentSeeder extends Seeder
{




    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = [
            (object)[
                'profile'=>'test00000',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test00001',
                'langs'=>['c','c++']
            ],
            (object)[
                'profile'=>'test00010',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test00011',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test00100',
                'langs'=>['c','c++']
            ],
            (object)[
                'profile'=>'test00101',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test00110',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test00111',
                'langs'=>['c','c++','java']
            ],
            (object)[
                'profile'=>'test01000',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01001',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01010',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01011',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01100',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01101',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01110',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test01111',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10000',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10001',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10010',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10011',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10100',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10101',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10110',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test10111',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test11000',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test11001',
                'langs'=>['c']
            ],
            (object)[
                'profile'=>'test11010',
                'langs'=>['c']
            ]
        ];

        $testAssignment = Assignment::where('code', 'test-assignment')->first();
        if($testAssignment == null){
            $testAssignment = Assignment::Create([
                'code' => 'test-assignment',
                'author_id' => 2,
                'group_id' => 1,
                'name' => 'Test',
                'description' => 'test assignment',
                'text' => 'dsd',
                'checked_at' => '2016-12-24 14:26:48',
                'start_at' => '2016-12-24 14:26:48',
                'deadline_at' => '2016-12-24 14:26:48'
            ]);
        }

        $school = School::where('code', 'test-school')->first();
        if($school == null){
            $school = School::create([
                'name' => 'Test School',
                'code' => 'test-school',
                'address' => '',
                'url' => ''
            ]);
        }

        $group = Group::where('code', 'test-group')->first();
        if($group == null){
            $group = Group::create([
                'name' => 'Test Group',
                'code' => 'test-group',
                'school_id' => $school->id,
                'is_public' => false
            ]);
        }

        foreach($tests as $test){

            $code = $test->user;

            $user = User::where('code', $code)->first();
            if($user == null){
                $user = User::create([
                    'name' => $code,
                    'code' => $code,
                    'email' => $code.'@codeleague.sk',
                    'school_id' => $school->id
                ]);

                $user->groups()->attach($group->id);
            }

            foreach($test->langs as $lang){
                $solution = $user->solutions()->where('assignment_id', $testAssignment->id)->where('lang', $lang)->first();
                if($solution == null){
                    $solution = AssignmentSolution::create([
                        'assignment_id' => $testAssignment->id,
                        'user_id' => $user->id,
                        'filename' => '',
                        'lang' => $lang
                    ]);

                    echo $user->code . ' - ' . $solution->lang . PHP_EOL;
                }
            }
        }
    }
}
