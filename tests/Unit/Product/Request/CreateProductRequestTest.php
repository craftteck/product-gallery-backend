<?php

use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateProductRequestTest extends TestCase
{
    #[Test]
    public function 正しいパラメータが渡された場合、バリデーションが通過する(): void
    {
        $params = [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
        ];
        $formRequest = new CreateProductRequest();
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
        ];
        $formRequest = new CreateProductRequest();
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
        ];
        $formRequest = new CreateProductRequest();
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
        ];
        $formRequest = new CreateProductRequest();
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
        ];
        $formRequest = new CreateProductRequest();
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

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }
}
