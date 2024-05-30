<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Usecase\Product\Update\UpdateProductCommand;
use Packages\Usecase\Product\Update\UpdateProductDto;
use Packages\Usecase\Product\Update\UpdateProductInteractorInterface;

class UpdateProductController extends Controller
{
    public function __construct(
        private UpdateProductInteractorInterface $interactor,
    ) {}

    // TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
    public function Update(UpdateProductRequest $request): JsonResponse {
        $command = $this->toCommand($request);
        $dto = $this->interactor->execute($command);
        return $this->toResponse($dto);
    }

    private function toCommand(UpdateProductRequest $request): UpdateProductCommand {
        $id = $request->route('id');
        $castedId = is_numeric($id) ? (int) $id : abort(500);

        return new UpdateProductCommand(
            id: $castedId,
            userId: (int) Auth::id(),
            name: $request->string('name'),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
        );
    }

    private function toResponse(UpdateProductDto $dto): JsonResponse {
        return response()->json(get_object_vars($dto));
    }
}
