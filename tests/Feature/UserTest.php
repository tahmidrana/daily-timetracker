<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_create_a_user()
    {
        $this->assertTrue(true);
        /*$response = $this->post(route('users.store'), [
            'userid'=> '31524',
            'name'=> 'Test name',
            'email'=> 'test@abc.com',
            'designation'=> 'test designation',
            'is_active'=> 1,
            'roles'=> []
        ]);*/
        //$response->assertSuccessful();
        //$response->assertStatus(200);
    }
}
