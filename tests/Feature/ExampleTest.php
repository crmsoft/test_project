<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * is php artisan migrate cmd has been run
     */
    public function testMigration(){
        $this->assertDatabaseMissing('users', [
            'email' => 'ahmet@.com'
        ]);
    }

    /**
     * Test Login page exists
     */
    public function testLogin(){
        $resource = $this->get(route('login'));

        $resource->assertStatus(200);
    }

    /**
     * Our application is not considers registration
     */
    public function testRegisterDisabled(){
        $resource = $this->get(route('register'));

        $resource->assertStatus(302);
    }
}
