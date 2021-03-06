<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     *
     * @test
     * @throws \Throwable
     */
    public function users_can_create_statuses()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->type('body', 'Mi primer status')
                    ->press('#create-status')
                    ->assertSee('Mi primer status')
                    ;
        });
    }
}
