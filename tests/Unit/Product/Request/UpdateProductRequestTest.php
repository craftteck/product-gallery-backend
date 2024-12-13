<?php

use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateProductRequestTest extends TestCase
{
    #[Test]
    public function 正しいパラメータが渡された場合、バリデーションが通過する(): void
    {
        $params = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 2,
        ];
        $formRequest = new UpdateProductRequest();
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
        $params = [
            'name' => null,
            'summary' => null,
            'description' => null,
            'url' => null,
            'version' => null,
        ];
        $formRequest = new UpdateProductRequest();
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

            $this->assertArrayHasKey('name', $errors);
            $this->assertContains('プロダクト名 は必須です。', $errors['name']);

            $this->assertArrayHasKey('summary', $errors);
            $this->assertContains('概要 は必須です。', $errors['summary']);

            $this->assertArrayHasKey('description', $errors);
            $this->assertContains('説明 は必須です。', $errors['description']);

            $this->assertArrayHasKey('url', $errors);
            $this->assertContains('URL は必須です。', $errors['url']);

            $this->assertArrayHasKey('version', $errors);
            $this->assertContains('バージョン は必須です。', $errors['version']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    #[Test]
    public function 文字列のパラメータに文字列以外が渡された場合、バリデーションが失敗する(): void
    {
        $params = [
            'name' => 0,
            'summary' => 0,
            'description' => 0,
            'url' => 'http://example.com',
            'version' => 2
        ];
        $formRequest = new UpdateProductRequest();
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

            $this->assertArrayHasKey('name', $errors);
            $this->assertContains('プロダクト名 は文字列である必要があります。', $errors['name']);

            $this->assertArrayHasKey('summary', $errors);
            $this->assertContains('概要 は文字列である必要があります。', $errors['summary']);

            $this->assertArrayHasKey('description', $errors);
            $this->assertContains('説明 は文字列である必要があります。', $errors['description']);

            $this->assertArrayNotHasKey('url', $errors);
            $this->assertArrayNotHasKey('version', $errors);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    #[Test]
    public function 数値のパラメータに数値以外が渡された場合、バリデーションが失敗する(): void
    {
        $params = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
            'version' => 'version',
        ];
        $formRequest = new UpdateProductRequest();
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

            $this->assertArrayNotHasKey('name', $errors);
            $this->assertArrayNotHasKey('summary', $errors);
            $this->assertArrayNotHasKey('description', $errors);
            $this->assertArrayNotHasKey('url', $errors);

            $this->assertArrayHasKey('version', $errors);
            $this->assertContains('バージョン は整数である必要があります。', $errors['version']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    #[Test]
    public function urlにURL以外の書式の文字列が渡された場合、バリデーションが失敗する(): void
    {
        $params = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'not url',
            'version' => 2,
        ];
        $formRequest = new UpdateProductRequest();
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

            $this->assertArrayNotHasKey('name', $errors);
            $this->assertArrayNotHasKey('summary', $errors);
            $this->assertArrayNotHasKey('description', $errors);

            $this->assertArrayHasKey('url', $errors);
            $this->assertContains('URL は有効なURLである必要があります。', $errors['url']);

            $this->assertArrayNotHasKey('version', $errors);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    #[Test]
    public function 最大文字数を超過する文字列が渡された場合、バリデーションが失敗する(): void
    {
        $params = [
            'name' => str_repeat('A', 101),
            'summary' => str_repeat('A', 301),
            'description' => str_repeat('A', 2001),
            'url' => 'http://example.com',
            'version' => 2,
        ];
        $formRequest = new UpdateProductRequest();
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

            $this->assertArrayHasKey('name', $errors);
            $this->assertContains('プロダクト名 は 100 文字以下である必要があります。', $errors['name']);

            $this->assertArrayHasKey('summary', $errors);
            $this->assertContains('概要 は 300 文字以下である必要があります。', $errors['summary']);

            $this->assertArrayHasKey('description', $errors);
            $this->assertContains('説明 は 2000 文字以下である必要があります。', $errors['description']);

            $this->assertArrayNotHasKey('url', $errors);
            $this->assertArrayNotHasKey('version', $errors);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }
}
