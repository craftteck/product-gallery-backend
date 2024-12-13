<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\DeleteFavoriteRequest;
use Illuminate\Http\Response;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCaseInput;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCaseInterface;

/**
 * お気に入り削除のコントローラークラス
 */
class DeleteFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteFavoriteUseCaseInterface $useCase
     */
    public function __construct(
        private DeleteFavoriteUseCaseInterface $useCase,
    ) {
    }

    /**
     * お気に入りを削除する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param DeleteFavoriteRequest $request
     * @return Response
     */
    public function delete(DeleteFavoriteRequest $request): Response
    {
        $useCaseInput = $this->toUseCaseInput($request);
        $this->useCase->execute($useCaseInput);
        return response()->noContent();
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param DeleteFavoriteRequest $request
     * @return DeleteFavoriteUseCaseInput
     */
    private function toUseCaseInput(DeleteFavoriteRequest $request): DeleteFavoriteUseCaseInput
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteFavoriteUseCaseInput(ids: $ids);
    }
}
