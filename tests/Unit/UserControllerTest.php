<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\UserController;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGettingAllUsers()
    {
        $response = $this->json('GET','/api/users');
        $response->assertStatus(200);
        $response->assertJsonStructure(
                [
                    '0' => [
                        [
                        'id',
                        'name',
                        'email',
                        'created_at'
                            ]
                    ]
                ]
        );
    }
}
