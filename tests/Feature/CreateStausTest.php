<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models;

class CreateStausTest extends TestCase
{
    use RefreshDatabase;
    function test_guests_users_can_not_create_statuses()
    {
        $response = $this->post(route('statuses.store'),['body' => 'Mi primer status']);
        $response->assertRedirect('login');
    }

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
        $response = $this->postJson(route('statuses.store'),['body' => 'Mi primer status']);
        $response->assertJson([
            'body' => 'Mi primer status'
        ]);
        //3. Then => Estonces - Comprobamos que los resultados obtenidos son los que esperamos. "ENTONCES veo un nuevo estado en la base de datos"
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }
    function test_a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->postJson(route('statuses.store'),['body' => '']);
        $responce->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
    function test_a_status_body_requires_a_minium_length()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->postJson(route('statuses.store'),['body' => 'hshsh']);
        $responce->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
