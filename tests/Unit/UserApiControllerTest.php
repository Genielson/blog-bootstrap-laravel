<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Tests\TestCase;

class UserApiControllerTest extends TestCase
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

    public function testCreateAUser(){
        $email = "teste".rand(0,100)."@gmail.com";
        $response = $this->json('POST','/api/users/create',[
            'name' => 'Genielson',
            'email' => $email,
            'password' => Hash::make('testeteste')
        ]);
        $response->assertStatus(200);
        self::assertEquals(true,$response->getData()->success);
    }

    public function testDeleteAUser(){
        $listTestUsers = $this->json('GET','/api/users');
        $response = $this->json('DELETE',"/api/users/delete/{$listTestUsers[0][5]['id']}");
        $response->assertStatus(204);
    }
}
