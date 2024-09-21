<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\CreateFavoriteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseInput;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseInterface;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseOutput;

/**
 * お気に入り登録のコントローラークラス
 */
class CreateFavoriteController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateFavoriteUsecaseInterface $usecase
     */
    public function __construct(
        private CreateFavoriteUsecaseInterface $usecase,
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
        $usecaseInput = $this->toUsecaseInput($request);
        $usecaseOutput = $this->usecase->execute($usecaseInput);
        return $this->toResponse($usecaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param CreateFavoriteRequest $request
     * @return CreateFavoriteUsecaseInput
     */
    private function toUsecaseInput(CreateFavoriteRequest $request): CreateFavoriteUsecaseInput
    {
        return new CreateFavoriteUsecaseInput(
            userId: (int) Auth::id(),
            productId: $request->integer('product_id'),
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param CreateFavoriteUsecaseOutput $usecaseOutput
     * @return JsonResponse
     */
    private function toResponse(CreateFavoriteUsecaseOutput $usecaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($usecaseOutput));
    }
}
