<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Usecase\Product\CreateProductCommand;
use Packages\Usecase\Product\CreateProductDto;
use Packages\Usecase\Product\CreateProductInteractorInterface;

class CreateProductController extends Controller
{
    public function __construct(
        private CreateProductInteractorInterface $interactor,
    ) {}

    // TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
    public function create(CreateProductRequest $request): JsonResponse {
        $command = $this->toCommand($request);
        $dto = $this->interactor->execute($command);
        return $this->toResponse($dto);
    }

    private function toCommand(CreateProductRequest $request): CreateProductCommand {
        return new CreateProductCommand(
            userId: (int) Auth::id(),
            name: $request->string('name'),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
        );
    }

    private function toResponse(CreateProductDto $dto): JsonResponse {
        return response()->json(get_object_vars($dto));
    }
}
