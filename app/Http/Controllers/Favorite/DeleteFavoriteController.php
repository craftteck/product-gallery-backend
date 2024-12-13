<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\DeleteFavoriteRequest;
use Illuminate\Http\Response;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteCommand;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCase;

/**
 * お気に入り削除のコントローラークラス
 */
class DeleteFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DeleteFavoriteUseCase $useCase
     */
    public function __construct(
        private DeleteFavoriteUseCase $useCase,
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
        $command = $this->toCommand($request);
        $this->useCase->execute($command);
        return response()->noContent();
    }

    /**
     * リクエストをコマンドに変換する
     *
     * @param DeleteFavoriteRequest $request
     * @return DeleteFavoriteCommand
     */
    private function toCommand(DeleteFavoriteRequest $request): DeleteFavoriteCommand
    {
        /** @var array<int> $ids */
        $ids = $request->input('ids');
        return new DeleteFavoriteCommand(ids: $ids);
    }
}
