<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Product::factory(3)->create(['user_id' => $this->user->id]);
    }

    /**
     * 204 削除成功
     */
    public function test_204(): void
    {
        $this->actingAs($this->user, 'web');

        $body = ['ids' => [1, 2]];
        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/products', $body, $headers);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => 1]);
        $this->assertDatabaseMissing('products', ['id' => 2]);

        $this->assertDatabaseHas('products', ['id' => 3]);
    }

    /**
     * 401 認証エラー
     */
    public function test_401(): void
    {
        $body = ['ids' => [1, 2]];
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

        $body = ['ids' => null];
        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/products', $body, $headers);

        $response->assertStatus(422)->assertJson(
            [
                'errors' => [
                    'ids' => [
                        'IDのリスト は必須です。'
                    ],
                ]
            ]
        );
    }
}