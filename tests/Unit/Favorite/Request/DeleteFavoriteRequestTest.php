<?php

use App\Http\Requests\Favorite\DeleteFavoriteRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteFavoriteRequestTest extends TestCase
{
    #[Test]
    public function 正しいパラメータが渡された場合、バリデーションが通過する(): void
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

    #[Test]
    public function 必須のパラメータが存在しない場合、バリデーションが失敗する(): void
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

    #[Test]
    public function 配列のパラメータに配列以外が渡された場合、バリデーションが失敗する(): void
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

    #[Test]
    public function 数値のパラメータに数値以外が渡された場合、バリデーションが失敗する(): void
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
