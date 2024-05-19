<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 登録成功
     */
    public function test_success(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/products', [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);

        $response->assertStatus(200)->assertJson([
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);

        $this->assertDatabaseHas('products', [
            'id' => 1,
            'user_id' => $user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);
    }

    /**
     * バリデーション失敗
     */
    public function test_validation_error(): void
    {
        User::factory()->create();

        $response = $this->post('/api/products', [
            'name' => null,
            'summary' => null,
            'description' => null,
            'url' => null,
        ]);

        $response->assertStatus(400)->assertJson(
            [
                "errors" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "summary" => [
                        "The summary field is required."
                    ],
                    "description" => [
                        "The description field is required."
                    ],
                    "url" => [
                        "The url field is required."
                    ]
                ]
            ]
        );
    }
}
