<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\Product\Update\UpdateProductUseCaseInput;
use Packages\UseCase\Product\Update\UpdateProductUseCaseInterface;
use Packages\UseCase\Product\Update\UpdateProductUseCaseOutput;

/**
 * プロダクト更新のコントローラークラス
 */
class UpdateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param UpdateProductUseCaseInterface $useCase
     */
    public function __construct(
        private UpdateProductUseCaseInterface $useCase,
    ) {
    }

    /**
     * プロダクトを更新する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param UpdateProductRequest $request
     * @return JsonResponse
     */
    public function Update(UpdateProductRequest $request): JsonResponse
    {
        $useCaseInput = $this->toUseCaseInput($request);
        $useCaseOutput = $this->useCase->execute($useCaseInput);
        return $this->toResponse($useCaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param UpdateProductRequest $request
     * @return UpdateProductUseCaseInput
     */
    private function toUseCaseInput(UpdateProductRequest $request): UpdateProductUseCaseInput
    {
        /** @var int $id */
        $id = $request->route('id');

        return new UpdateProductUseCaseInput(
            id: $id,
            userId: (int) Auth::id(),
            name: $request->string('name'),
            summary: $request->string('summary'),
            description: $request->string('description'),
            url: $request->string('url'),
            version: $request->integer('version'),
        );
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param UpdateProductUseCaseOutput $useCaseOutput
     * @return JsonResponse
     */
    private function toResponse(UpdateProductUseCaseOutput $useCaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($useCaseOutput));
    }
}
