<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\Product\Create\CreateProductUseCaseInput;
use Packages\UseCase\Product\Create\CreateProductUseCaseInterface;
use Packages\UseCase\Product\Create\CreateProductUseCaseOutput;

/**
 * プロダクト新規作成のコントローラークラス
 */
class CreateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param CreateProductUseCaseInterface $useCase
     */
    public function __construct(
        private CreateProductUseCaseInterface $useCase,
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
        $useCaseInput = $this->toUseCaseInput($request);
        $useCaseOutput = $this->useCase->execute($useCaseInput);
        return $this->toResponse($useCaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param CreateProductRequest $request
     * @return CreateProductUseCaseInput
     */
    private function toUseCaseInput(CreateProductRequest $request): CreateProductUseCaseInput
    {
        return new CreateProductUseCaseInput(
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
     * @param CreateProductUseCaseOutput $useCaseOutput
     * @return JsonResponse
     */
    private function toResponse(CreateProductUseCaseOutput $useCaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($useCaseOutput));
    }
}
