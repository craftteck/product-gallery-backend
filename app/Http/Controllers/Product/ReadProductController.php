<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReadProductRequest;
use Illuminate\Http\JsonResponse;
use Packages\Usecase\Product\Read\ReadProductCommand;
use Packages\Usecase\Product\Read\ReadProductDto;
use Packages\Usecase\Product\Read\ReadProductInteractorInterface;

class ReadProductController extends Controller
{
    public function __construct(
        private ReadProductInteractorInterface $interactor,
    ) {}

    // TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
    public function read(ReadProductRequest $request): JsonResponse {
        $command = $this->toCommand($request);
        $dto = $this->interactor->execute($command);
        return $this->toResponse($dto);
    }

    private function toCommand(ReadProductRequest $request): ReadProductCommand {
        $id = $request->route('id');
        $castedId = is_numeric($id) ? (int) $id : abort(500);

        return new ReadProductCommand(id: $castedId);
    }

    private function toResponse(ReadProductDto $dto): JsonResponse {
        return response()->json(get_object_vars($dto));
    }
}
