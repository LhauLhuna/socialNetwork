<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class CreateStausTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_cretaed_statuses()
    {
        //1. Given => Teniendo - Aqui se crea el contexto es decir cual es el estado de la aplicacion antes de realizar la accion que queeremos comprobar. "TENIENDO un usuario autentificado"
        $user = factory(User::class)->create();
        $this->actingAs($user);
        //2. When => Cuando - Realizamod dicha accion que queremos comprobar. "CUANDO hace un post request a status"
        $this->post(route('statuses.store'),['body' => 'Mi primer status']);
        //3. Then => Estonces - Comprobamos que los resultados obtenidos son los que esperamos. "ENTONCES veo un nuevo estado en la base de datos"
        $this->assertDatabaseHas('statuses', [
            'body' => 'Mi primer status'
        ]);
    }
}
