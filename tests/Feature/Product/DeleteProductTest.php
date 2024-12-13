<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    /** @var User $user */
    private User $user;

    /** @var Collection<int,Product> $products */
    private Collection $products;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->products = Product::factory(3)->create(['user_id' => $this->user->id]);
    }

    #[Test]
    public function プロダクトの削除に成功する(): void
    {
        $this->actingAs($this->user, 'web');

        $body = ['ids' => [
            $this->products[0]?->id,
            $this->products[1]?->id,
        ]];
        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/products', $body, $headers);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => $this->products[0]?->id]);
        $this->assertDatabaseMissing('products', ['id' => $this->products[1]?->id]);

        $this->assertDatabaseHas('products', ['id' => $this->products[2]?->id]);
    }

    #[Test]
    public function ユーザーに権限がない場合、認証エラーになる(): void
    {
        $body = ['ids' => [
            $this->products[0]?->id,
            $this->products[1]?->id,
        ]];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/products', $body, $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    #[Test]
    public function パラメータが不正な場合、バリデーションエラーになる(): void
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
