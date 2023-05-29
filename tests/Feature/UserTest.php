<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

    }

    public function test_post_login()
    {
        $response= $this->post('/act-login');
        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }

    public function test_logout()
    {
        $response = $this->get('/logout');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

    public function test_home()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function test_user()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
    }
   
}
