<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use Illuminate\Http\Response;
use Packages\Usecase\Product\Delete\DeleteProductCommand;
use Packages\Usecase\Product\Delete\DeleteProductInteractorInterface;

class DeleteProductController extends Controller
{
    public function __construct(
        private DeleteProductInteractorInterface $interactor,
    ) {}

    // TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
    public function delete(DeleteProductRequest $request): Response {
        $command = $this->toCommand($request);
        $this->interactor->execute($command);
        return response()->noContent();
    }

    private function toCommand(DeleteProductRequest $request): DeleteProductCommand {
        return new DeleteProductCommand(
            ids: (array) $request->input('ids'),
        );
    }
}
