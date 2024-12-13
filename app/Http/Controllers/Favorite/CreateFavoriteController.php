<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\CreateFavoriteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseInput;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseInterface;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseOutput;

/**
 * お気に入り登録のコントローラークラス
 */
class CreateFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateFavoriteUseCaseInterface $useCase
     */
    public function __construct(
        private CreateFavoriteUseCaseInterface $useCase,
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
        $useCaseInput = $this->toUseCaseInput($request);
        $useCaseOutput = $this->useCase->execute($useCaseInput);
        return $this->toResponse($useCaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param CreateFavoriteRequest $request
     * @return CreateFavoriteUseCaseInput
     */
    private function toUseCaseInput(CreateFavoriteRequest $request): CreateFavoriteUseCaseInput
    {
        return new CreateFavoriteUseCaseInput(
            userId: (int) Auth::id(),
            productId: $request->integer('product_id'),
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param CreateFavoriteUseCaseOutput $useCaseOutput
     * @return JsonResponse
     */
    private function toResponse(CreateFavoriteUseCaseOutput $useCaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($useCaseOutput));
    }
}
