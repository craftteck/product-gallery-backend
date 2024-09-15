<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use Illuminate\Http\Response;
use Packages\Usecase\Product\Delete\DeleteProductUsecaseInput;
use Packages\Usecase\Product\Delete\DeleteProductUsecaseInterface;

/**
 * プロダクト削除のコントローラークラス
 */
class DeleteProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteProductUsecaseInterface $usecase
     */
    public function __construct(
        private DeleteProductUsecaseInterface $usecase,
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
        $usecaseInput = $this->toUsecaseInput($request);
        $this->usecase->execute($usecaseInput);
        return response()->noContent();
    }

    /**
     * リクエストをコマンドクラスに変換する
     *
     * @param DeleteProductRequest $request
     * @return DeleteProductUsecaseInput
     */
    private function toUsecaseInput(DeleteProductRequest $request): DeleteProductUsecaseInput
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteProductUsecaseInput(ids: $ids);
    }
}
