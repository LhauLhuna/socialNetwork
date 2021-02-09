<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     * @throws
     */
    public function test_registered_users_can_login()
    {
        factory(User::class())->create(['email' => 'lhau@lhuna']);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'lhau@lhuna.com')
                    ->type('password', 'abrir123')
                    ->press('#login-btn')
                    ->assertPathIS('/')
                    ->assertAuthenticated()
                    ;
        });
    }
}
