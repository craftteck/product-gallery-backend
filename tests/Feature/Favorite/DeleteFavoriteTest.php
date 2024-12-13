<?php

namespace Tests\Feature\Product;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteFavoriteTest extends TestCase
{
    use RefreshDatabase;

    /** @var User $user */
    private User $user;

    /** @var Collection<int,Favorite> $favorites */
    private Collection $favorites;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->favorites = Favorite::factory(3)->create(['user_id' => $this->user->id]);
    }

    #[Test]
    public function お気に入りの削除に成功する(): void
    {
        $this->actingAs($this->user, 'web');

        $body = ['ids' => [
            $this->favorites[0]?->id,
            $this->favorites[1]?->id,
        ]];
        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/favorites', $body, $headers);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('favorites', ['id' => $this->favorites[0]?->id]);
        $this->assertDatabaseMissing('favorites', ['id' => $this->favorites[1]?->id]);

        $this->assertDatabaseHas('favorites', ['id' => $this->favorites[2]?->id]);
    }

    #[Test]
    public function ユーザーに権限がない場合、認証エラーになる(): void
    {
        $body = ['ids' => [
            $this->favorites[0]?->id,
            $this->favorites[1]?->id,
        ]];
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

        $body = ['ids' => null];
        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/favorites', $body, $headers);

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
