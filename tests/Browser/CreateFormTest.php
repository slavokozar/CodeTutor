<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Faker\Factory as Faker;

class CreateFormTest extends DuskTestCase
{

    public function testEmptyValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(action('Users\UserController@create'))
                ->pause(5000)
                ->assertVisible('.btn-submit')
                ->click('.btn-submit')
                ->pause(2000)
                ->assertSeeIn('input[name="name"] + span.help-block', trans('validation.required'))
                ->assertSeeIn('input[name="surname"] + span.help-block', trans('validation.required'))
                ->assertSeeIn('input[name="email"] + span.help-block', trans('validation.required'))
                ->assertSeeIn('input[name="birthdate"] + span.help-block', trans('validation.required'));
        });
    }


    public function testFilled()
    {
        $this->browse(function (Browser $browser) {

            $faker = Faker::create();

            $name = 'Slavo';
            $surname = "Kozar";
            $email = $faker->email();
            $birthdate = '24.03.1993';


            $browser->visit(action('Users\UserController@create'))
                ->pause(5000)
                ->assertVisible('.btn-submit')
                ->type('name', $name)
                ->pause(2000)
                ->type('surname', $surname)
                ->pause(2000)
                ->type('email', $email)
                ->pause(2000)
                ->keys('[name="birthdate"]', str_replace('.', '', $birthdate))
                ->pause(2000)
                ->click('.btn-submit')
                ->pause(2000)
                ->assertSeeIn('h1',$name)
                ->pause(5000);
        });
    }

}