<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskWithMigrationsTestCase;

class CreateSiteTest extends DuskWithMigrationsTestCase
{
    public function test()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                ->visit(action('Builder\Web\SiteController@index'))
                ->waitFor('.cookieinfo-close')
                ->click('.cookieinfo-close')
                ->assertSeeIn('.add-panel-page a', trans('builder/sites.index.page-creation'))
                ->click('.add-panel-page a')
                ->click('.continue.bubble')
                ->waitFor('.modal')
                ->click('.modal .btn-success')
                ->assertSee(trans('builder/wizard.designs.heading'))
                ->mouseover('[data-template="big-city"]')
                ->click('[data-template="big-city"] .template-btns .btn-select')
                ->click('.continue')
                ->click('.continue');

            $this->assertDatabaseHas('web_sites', [
                'user_id'     => 2,
                'template_id' => 10,
                'color_id'    => 11
            ]);

        });
    }
}
