<?php

use App\Http\Requests\Favorite\DeleteFavoriteRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class DeleteFavoriteRequestTest extends TestCase
{
    /**
     * バリデーション通過
     */
    public function test_success_all(): void
    {
        $params = ['ids' => [1, 2, 3]];
        $formRequest = new DeleteFavoriteRequest();
        $validator = Validator::make(
            $params,
            $formRequest->rules(),
            $formRequest->messages(),
            $formRequest->attributes(),
        );

        try {
            $validator->validate();
            $this->assertTrue(true);
        } catch (ValidationException $e) {
            $this->fail('ValidationException was thrown.');
        }
    }

    /**
     * required エラーの検証
     */
    public function test_fails_required_rule(): void
    {
        $params = ['ids' => []];
        $formRequest = new DeleteFavoriteRequest();
        $validator = Validator::make(
            $params,
            $formRequest->rules(),
            $formRequest->messages(),
            $formRequest->attributes(),
        );

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('ids', $errors);
            $this->assertContains('IDのリスト は必須です。', $errors['ids']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    /**
     * array エラーの検証
     */
    public function test_fails_array_rule(): void
    {
        $params = ['ids' => 1];
        $formRequest = new DeleteFavoriteRequest();
        $validator = Validator::make(
            $params,
            $formRequest->rules(),
            $formRequest->messages(),
            $formRequest->attributes(),
        );

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('ids', $errors);
            $this->assertContains('IDのリスト は配列である必要があります。', $errors['ids']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    /**
     * integer エラーの検証
     */
    public function test_fails_integer_rule(): void
    {
        $params = ['ids' => ['a']];
        $formRequest = new DeleteFavoriteRequest();
        $validator = Validator::make(
            $params,
            $formRequest->rules(),
            $formRequest->messages(),
            $formRequest->attributes(),
        );

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('ids.0', $errors);
            $this->assertContains('ID は整数である必要があります。', $errors['ids.0']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }
}
