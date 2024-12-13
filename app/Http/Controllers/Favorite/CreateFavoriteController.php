<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\CreateFavoriteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCase;
use Packages\UseCase\Favorite\Create\RegisterFavoriteCommand;
use Packages\UseCase\Favorite\FavoriteDto;

/**
 * お気に入り登録のコントローラークラス
 */
class CreateFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateFavoriteUseCase $useCase
     */
    public function __construct(
        private CreateFavoriteUseCase $useCase,
    ) {
    }

    /**
     * お気に入りを登録する
     *
     * @param CreateFavoriteRequest $request
     * @return JsonResponse
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     */
    public function create(CreateFavoriteRequest $request): JsonResponse
    {
        $command = $this->toCommand($request);
        $dto = $this->useCase->execute($command);
        return $this->toResponse($dto);
    }

    /**
     * リクエストをコマンドに変換する
     *
     * @param CreateFavoriteRequest $request
     * @return RegisterFavoriteCommand
     */
    private function toCommand(CreateFavoriteRequest $request): RegisterFavoriteCommand
    {
        return new RegisterFavoriteCommand(
            userId: (int) Auth::id(),
            productId: $request->integer('product_id'),
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param FavoriteDto $dto
     * @return JsonResponse
     */
    private function toResponse(FavoriteDto $dto): JsonResponse
    {
        return response()->json(get_object_vars($dto));
    }
}
