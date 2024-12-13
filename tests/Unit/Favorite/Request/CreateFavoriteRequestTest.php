<?php

use App\Http\Requests\Favorite\CreateFavoriteRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFavoriteRequestTest extends TestCase
{
    #[Test]
    public function 正しいパラメータが渡された場合、バリデーションが通過する(): void
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

    #[Test]
    public function 必須のパラメータが存在しない場合、バリデーションが失敗する(): void
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

    #[Test]
    public function 数値のパラメータに数値以外が渡された場合、バリデーションが失敗する(): void
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
