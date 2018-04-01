<?php

namespace Tests\Unit;

use App\Models\Users\User;

use Faker\Factory as Faker;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function testCreateUser(){

        $faker = Faker::create();

        $data = [
            'name' => 'Slavo',
            'surname' => "Kozar",
            'email' => $faker->email(),
            'code' => $faker->word,
            'birthdate' => '1993-03-24'
        ];

        User::create($data);

        $this->assertDatabaseHas('users', $data);
    }



}
