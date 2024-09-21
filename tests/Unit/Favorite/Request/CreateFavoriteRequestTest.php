<?php

use App\Http\Requests\Favorite\CreateFavoriteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CreateFavoriteRequestTest extends TestCase
{
    /**
     * バリデーション通過
     */
    public function test_success_all(): void
    {
        $params = ['product_id' => 1];
        $formRequest = new CreateFavoriteRequest();
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
        $params = ['product_id' => null];
        $formRequest = new CreateFavoriteRequest();
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

            $this->assertArrayHasKey('product_id', $errors);
            $this->assertContains('プロダクトID は必須です。', $errors['product_id']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    /**
     * integer エラーの検証
     */
    public function test_fails_integer_rule(): void
    {
        $params = ['product_id' => 'a'];
        $formRequest = new CreateFavoriteRequest();
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

            $this->assertArrayHasKey('product_id', $errors);
            $this->assertContains('プロダクトID は整数である必要があります。', $errors['product_id']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }
}
