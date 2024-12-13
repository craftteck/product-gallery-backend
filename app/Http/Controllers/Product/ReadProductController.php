<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReadProductRequest;
use Illuminate\Http\JsonResponse;
use Packages\UseCase\Product\ProductDto;
use Packages\UseCase\Product\Read\ReadProductCommand;
use Packages\UseCase\Product\Read\ReadProductUseCase;

/**
 * プロダクト取得のコントローラークラス
 */
class ReadProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param ReadProductUseCase $useCase
     */
    public function __construct(
        private ReadProductUseCase $useCase,
    ) {
    }

    /**
     * プロダクトを取得する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param ReadProductRequest $request
     * @return JsonResponse
     */
    public function read(ReadProductRequest $request): JsonResponse
    {
        $command = $this->toCommand($request);
        $dto = $this->useCase->execute($command);
        return $this->toResponse($dto);
    }

    /**
     * リクエストをコマンドに変換する
     *
     * @param ReadProductRequest $request
     * @return ReadProductCommand
     */
    private function toCommand(ReadProductRequest $request): ReadProductCommand
    {
        /** @var int $id */
        $id = $request->route('id');
        return new ReadProductCommand(id: $id);
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
