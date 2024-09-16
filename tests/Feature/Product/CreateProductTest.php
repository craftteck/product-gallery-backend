<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * 200 作成成功
     */
    public function test_200(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/products', $body, $headers);

        $response->assertStatus(200)->assertJson([
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => 1,
            'user_id' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ]);
    }

    /**
     * 401 認証エラー
     */
    public function test_401(): void
    {
        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/products', $body, $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    /**
     * 422 パラメーターエラー
     */
    public function test_422(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => null,
            'summary' => null,
            'description' => null,
            'url' => null,
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/products', $body, $headers);

        $response->assertStatus(422)->assertJson(
            [
                'errors' => [
                    'name' => [
                        'The name field is required.'
                    ],
                    'summary' => [
                        'The summary field is required.'
                    ],
                    'description' => [
                        'The description field is required.'
                    ],
                    'url' => [
                        'The url field is required.'
                    ]
                ]
            ]
        );
    }
}
