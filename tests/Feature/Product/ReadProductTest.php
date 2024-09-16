<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Product $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->product = Product::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);
    }

    /**
     * 200 取得成功
     */
    public function test_200(): void
    {
        $this->actingAs($this->user, 'web');

        $headers = ['Accept' => 'application/json'];
        $response = $this->get("/api/products/{$this->product->id}", $headers);

        $response->assertStatus(200)->assertJson([
            'id' => $this->product->id,
            'userId' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);
    }

    /**
     * 401 認証エラー
     */
    public function test_401(): void
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->get("/api/products/{$this->product->id}", $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    /**
     * 404
     * - URLが不正
     * - 対象リソースが存在しない
     */
    public function test_404(): void
    {
        $this->actingAs($this->user, 'web');

        $headers = ['Accept' => 'application/json'];

        // パスパラメータが不正
        $response = $this->get('/api/products/abc', $headers);
        $response->assertStatus(404)->assertJson([
            'message' => 'The route api/products/abc could not be found.',
        ]);

        // 指定されたパスパラメータのリソースが存在しない
        $response = $this->get('/api/products/0', $headers);
        $response->assertStatus(404)->assertJson([
            'message' => 'Target resource not found.',
        ]);
    }
}
