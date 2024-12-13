<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /** @var User $user */
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    #[Test]
    public function プロダクトの登録に成功する(): void
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
            'userId' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
        ]);

        $this->assertDatabaseHas('products', [
            'user_id' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 1,
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
    public function パラメータが不正な場合、バリデーションエラーになる(): void
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
                    ]
                ]
            ]
        );
    }
}
