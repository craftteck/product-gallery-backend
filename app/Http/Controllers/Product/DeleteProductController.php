<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use Illuminate\Http\Response;
use Packages\UseCase\Product\Delete\DeleteProductCommand;
use Packages\UseCase\Product\Delete\DeleteProductUseCase;

/**
 * プロダクト削除のコントローラークラス
 */
class DeleteProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteProductUseCase $useCase
     */
    public function __construct(
        private DeleteProductUseCase $useCase,
    ) {
    }

    /**
     * プロダクトを削除する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param DeleteProductRequest $request
     * @return Response
     */
    public function delete(DeleteProductRequest $request): Response
    {
        $command = $this->toCommand($request);
        $this->useCase->execute($command);
        return response()->noContent();
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param DeleteProductRequest $request
     * @return DeleteProductCommand
     */
    private function toCommand(DeleteProductRequest $request): DeleteProductCommand
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteProductCommand(ids: $ids);
    }
}
