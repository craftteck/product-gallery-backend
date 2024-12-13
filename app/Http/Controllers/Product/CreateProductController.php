<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Domain\Product\ProductName;
use Packages\UseCase\Product\Create\CreateProductUseCase;
use Packages\UseCase\Product\ProductDto;
use Packages\UseCase\Product\Create\RegisterProductCommand;

/**
 * プロダクト新規作成のコントローラークラス
 */
class CreateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateProductUseCase $useCase
     */
    public function __construct(
        private CreateProductUseCase $useCase
    ) {
    }

    /**
     * プロダクトを新規登録する
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     */
    public function create(CreateProductRequest $request): JsonResponse
    {
        $command = $this->toCommand($request);
        $dto = $this->useCase->execute($command);
        return $this->toResponse($dto);
    }

    /**
     * リクエストをコマンドに変換する
     *
     * @param CreateProductRequest $request
     * @return RegisterProductCommand
     */
    private function toCommand(CreateProductRequest $request): RegisterProductCommand
    {
        return new RegisterProductCommand(
            id: null,
            userId: (int) Auth::id(),
            name: new ProductName($request->string('name')),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
            version: null,
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param ProductDto $dto
     * @return JsonResponse
     */
    private function toResponse(ProductDto $dto): JsonResponse
    {
        return response()->json([
            'id' => $dto->id,
            'userId' => $dto->userId,
            'name' => $dto->name->value(),
            'summary' => $dto->summary,
            'description' => $dto->description,
            'url' => $dto->url,
            'version' => $dto->version,
        ]);
    }
}
