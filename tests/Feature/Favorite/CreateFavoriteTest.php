<?php

namespace Tests\Feature\Favorite;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFavoriteTest extends TestCase
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
        $this->product = Product::factory()->create();
    }

    #[Test]
    public function お気に入りの登録に成功する(): void
    {
        $this->actingAs($this->user, 'web');

        $body = ['product_id' => $this->product->id];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/favorites', $body, $headers);

        $response->assertStatus(200)->assertJson([
            'userId' => $this->user->id,
            'productId' => $this->product->id,
            'version' => 1,
        ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'version' => 1,
        ]);
    }

    #[Test]
    public function ユーザーに操作権限がない場合、認証エラーになる(): void
    {
        $body = ['product_id' => $this->product->id];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/favorites', $body, $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    #[Test]
    public function パラメータが不正な場合、バリデーションエラーになる(): void
    {
        $this->actingAs($this->user, 'web');

        $body = ['product_id' => null];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/favorites', $body, $headers);

        $response->assertStatus(422)->assertJson(
            [
                'errors' => [
                    'product_id' => [
                        'プロダクトID は必須です。'
                    ],
                ]
            ]
        );
    }
}
