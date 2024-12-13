<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateProductTest extends TestCase
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
        ]);
    }

    #[Test]
    public function プロダクトの更新に成功する(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(200)->assertExactJson([
            'id' => $this->product->id,
            'userId' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 2,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'user_id' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 2,
        ]);
    }

    #[Test]
    public function ユーザーに権限がない場合、認証エラーになる(): void
    {
        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    #[Test]
    public function 対象のプロダクトが存在しない場合、NotFoundエラーになる(): void
    {
        $this->actingAs($this->user, 'web');

        $headers = ['Accept' => 'application/json'];
        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ];

        // パスパラメータが不正
        $response = $this->put('/api/products/abc', $body, $headers);
        $response->assertStatus(404)->assertJson([
            'message' => 'The route api/products/abc could not be found.',
        ]);

        // 指定されたパスパラメータのリソースが存在しない
        $response = $this->put('/api/products/0', $body, $headers);
        $response->assertStatus(404)->assertJson([
            'message' => 'Target resource not found.',
        ]);
    }

    #[Test]
    public function 更新対象のプロダクトが直前に他のユーザーに更新されている場合、楽観ロックエラーになる(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 99,
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(409)->assertJson([
            'message' => 'The record has been modified by another process.',
        ]);
    }

    #[Test]
    public function パラメータが不正な場合、バリデーションエラーになる(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => null,
            'summary' => null,
            'description' => null,
            'url' => null,
            'version' => null,
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(422)->assertJson(
            [
                'errors' => [
                    'name' => [
                        'プロダクト名 は必須です。'
                    ],
                    'summary' => [
                        '概要 は必須です。'
                    ],
                    'description' => [
                        '説明 は必須です。'
                    ],
                    'url' => [
                        'URL は必須です。'
                    ],
                    'version' => [
                        'バージョン は必須です。'
                    ]
                ]
            ]
        );
    }
}
