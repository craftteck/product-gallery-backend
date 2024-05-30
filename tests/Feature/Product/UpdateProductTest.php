<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
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
        ]);
    }

    /**
     * 200
     */
    public function test_200(): void
    {
        $this->actingAs($this->user, 'web');

        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(200)->assertJson([
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'user_id' => $this->user->id,
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ]);
    }

    /**
     * 401
     */
    public function test_401(): void
    {
        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    /**
     * 404
     */
    public function test_404(): void
    {
        $this->actingAs($this->user, 'web');

        $headers = ['Accept' => 'application/json'];
        $body = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'url',
        ];

        // パスパラメータが不正
        $response = $this->put("/api/products/abc", $body, $headers);
        $response->assertStatus(404)->assertJson([
            'message' => "The route api/products/abc could not be found.",
        ]);

        // 指定されたパスパラメータのリソースが存在しない
        $response = $this->put("/api/products/0", $body, $headers);
        $response->assertStatus(404)->assertJson([
            'message' => "Target resource not found.",
        ]);
    }

    /**
     * 422
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
        $response = $this->put("/api/products/{$this->product->id}", $body, $headers);

        $response->assertStatus(422)->assertJson(
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
