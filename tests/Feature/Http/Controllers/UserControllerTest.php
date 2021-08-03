<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListingAllUsers()
    {
        User::factory()->count(3)->create();

        $response = $this->get('/api/users', [
            'Authorization' => 'Basic ' . base64_encode('user:test'),
        ]);

        $response->assertStatus(JsonResponse::HTTP_OK);

        $data = $response->json()['data'];

        $this->assertCount(3, $data);

    }
}
