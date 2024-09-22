<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\DeleteFavoriteRequest;
use Illuminate\Http\Response;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecaseInput;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecaseInterface;

/**
 * お気に入り削除のコントローラークラス
 */
class DeleteFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteFavoriteUsecaseInterface $usecase
     */
    public function __construct(
        private DeleteFavoriteUsecaseInterface $usecase,
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
        $usecaseInput = $this->toUsecaseInput($request);
        $this->usecase->execute($usecaseInput);
        return response()->noContent();
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param DeleteFavoriteRequest $request
     * @return DeleteFavoriteUsecaseInput
     */
    private function toUsecaseInput(DeleteFavoriteRequest $request): DeleteFavoriteUsecaseInput
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteFavoriteUsecaseInput(ids: $ids);
    }
}
