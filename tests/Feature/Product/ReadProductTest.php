<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReadProductTest extends TestCase
{
    use RefreshDatabase;

    /** @var User $user */
    private User $user;

    /** @var Product $product */
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

    #[Test]
    public function プロダクトの取得に成功する(): void
    {
        $this->actingAs($this->user, 'web');

        $headers = ['Accept' => 'application/json'];
        $response = $this->get("/api/products/{$this->product->id}", $headers);

        $response->assertStatus(200)->assertExactJson([
            'id' => $this->product->id,
            'userId' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
            'version' => 1,
        ]);
    }

    #[Test]
    public function ユーザーに権限がない場合、認証エラーになる(): void
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->get("/api/products/{$this->product->id}", $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    #[Test]
    public function 対象のプロダクトが存在しない場合、NotFoundエラーになる(): void
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
