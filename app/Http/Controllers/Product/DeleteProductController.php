<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use Illuminate\Http\Response;
use Packages\UseCase\Product\Delete\DeleteProductUseCaseInput;
use Packages\UseCase\Product\Delete\DeleteProductUseCaseInterface;

/**
 * プロダクト削除のコントローラークラス
 */
class DeleteProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteProductUseCaseInterface $useCase
     */
    public function __construct(
        private DeleteProductUseCaseInterface $useCase,
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
        $useCaseInput = $this->toUseCaseInput($request);
        $this->useCase->execute($useCaseInput);
        return response()->noContent();
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param DeleteProductRequest $request
     * @return DeleteProductUseCaseInput
     */
    private function toUseCaseInput(DeleteProductRequest $request): DeleteProductUseCaseInput
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteProductUseCaseInput(ids: $ids);
    }
}
