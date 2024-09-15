<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Usecase\Product\Create\CreateProductUsecaseInput;
use Packages\Usecase\Product\Create\CreateProductUsecaseInterface;
use Packages\Usecase\Product\Create\CreateProductUsecaseOutput;

/**
 * プロダクト新規作成のコントローラークラス
 */
class CreateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateProductUsecaseInterface $usecase
     */
    public function __construct(
        private CreateProductUsecaseInterface $usecase,
    ) {
    }

    /**
     * プロダクトを新規登録する
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     */
    public function create(CreateProductRequest $request): JsonResponse
    {
        $usecaseInput = $this->toUsecaseInput($request);
        $usecaseOutput = $this->usecase->execute($usecaseInput);
        return $this->toResponse($usecaseOutput);
    }

    /**
     * リクエストをコマンドクラスに変換する
     *
     * @param CreateProductRequest $request
     * @return CreateProductUsecaseInput
     */
    private function toUsecaseInput(CreateProductRequest $request): CreateProductUsecaseInput
    {
        return new CreateProductUsecaseInput(
            userId: (int) Auth::id(),
            name: $request->string('name'),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param CreateProductUsecaseOutput $usecaseOutput
     * @return JsonResponse
     */
    private function toResponse(CreateProductUsecaseOutput $usecaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($usecaseOutput));
    }
}
