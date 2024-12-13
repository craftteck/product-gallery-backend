<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\Product\ProductDto;
use Packages\UseCase\Product\Create\RegisterProductCommand;
use Packages\UseCase\Product\Update\UpdateProductUseCase;

/**
 * プロダクト更新のコントローラークラス
 */
class UpdateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param UpdateProductUseCase $useCase
     */
    public function __construct(
        private UpdateProductUseCase $useCase,
    ) {
    }

    /**
     * プロダクトを更新する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param UpdateProductRequest $request
     * @return JsonResponse
     */
    public function Update(UpdateProductRequest $request): JsonResponse
    {
        $command = $this->toCommand($request);
        $dto = $this->useCase->execute($command);
        return $this->toResponse($dto);
    }

    /**
     * リクエストをコマンドに変換する
     *
     * @param UpdateProductRequest $request
     * @return RegisterProductCommand
     */
    private function toCommand(UpdateProductRequest $request): RegisterProductCommand
    {
        /** @var int $id */
        $id = $request->route('id');

        return new RegisterProductCommand(
            id: $id,
            userId: (int) Auth::id(),
            name: $request->string('name'),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
            version: $request->integer('version'),
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
        return response()->json(get_object_vars($dto));
    }
}
