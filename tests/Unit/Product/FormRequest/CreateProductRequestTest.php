<?php

use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CreateProductRequestTest extends TestCase
{
    /**
     * バリデーション成功
     */
    public function test_success_all(): void
    {
        $request = Request::create('/api/products', 'GET', [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'http://example.com',
        ]);

        try {
            $this->app->make('Illuminate\Contracts\Validation\Factory')->validate(
                $request->all(),
                (new CreateProductRequest())->rules()
            );

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
        $request = Request::create('/api/products', 'GET', [
            'name' => null,
            'summary' => null,
            'description' => null,
            'url' => null,
        ]);

        try {
            $this->app->make('Illuminate\Contracts\Validation\Factory')->validate(
                $request->all(),
                (new CreateProductRequest())->rules()
            );
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('name', $errors);
            $this->assertContains('The name field is required.', $errors['name']);

            $this->assertArrayHasKey('summary', $errors);
            $this->assertContains('The summary field is required.', $errors['summary']);

            $this->assertArrayHasKey('description', $errors);
            $this->assertContains('The description field is required.', $errors['description']);

            $this->assertArrayHasKey('url', $errors);
            $this->assertContains('The url field is required.', $errors['url']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    /**
     * string エラーの検証
     */
    public function test_fails_string_rule(): void
    {
        $request = Request::create('/api/products', 'GET', [
            'name' => 0,
            'summary' => 0,
            'description' => 0,
            'url' => 'http://example.com',
        ]);

        try {
            $this->app->make('Illuminate\Contracts\Validation\Factory')->validate(
                $request->all(),
                (new CreateProductRequest())->rules()
            );
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('name', $errors);
            $this->assertContains('The name field must be a string.', $errors['name']);

            $this->assertArrayHasKey('summary', $errors);
            $this->assertContains('The summary field must be a string.', $errors['summary']);

            $this->assertArrayHasKey('description', $errors);
            $this->assertContains('The description field must be a string.', $errors['description']);

            $this->assertArrayNotHasKey('url', $errors);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }

    /**
     * url エラーの検証
     */
    public function test_fails_url_ruls(): void
    {
        $request = Request::create('/api/products', 'GET', [
            'name' => 'name',
            'summary' => 'summary',
            'description' => 'description',
            'url' => 'not url',
        ]);

        try {
            $this->app->make('Illuminate\Contracts\Validation\Factory')->validate(
                $request->all(),
                (new CreateProductRequest())->rules()
            );
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayNotHasKey('name', $errors);
            $this->assertArrayNotHasKey('summary', $errors);
            $this->assertArrayNotHasKey('description', $errors);

            $this->assertArrayHasKey('url', $errors);
            $this->assertContains('The url field must be a valid URL.', $errors['url']);

            return;
        }

        $this->fail('ValidationException was not thrown.');
    }
}
