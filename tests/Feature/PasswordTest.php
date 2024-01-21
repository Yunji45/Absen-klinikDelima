<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_password()
    {
        $response = $this->get('/ganti-password');

        $response->assertStatus(302);
    }

    public function test_updatepassword()
    {
        $response = $this->patch('/update-password/{user}');
        $response->assertStatus(419);

    }
}
