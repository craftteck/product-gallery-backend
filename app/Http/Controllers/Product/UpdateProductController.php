<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Usecase\Product\Update\UpdateProductUsecaseInput;
use Packages\Usecase\Product\Update\UpdateProductUsecaseInterface;
use Packages\Usecase\Product\Update\UpdateProductUsecaseOutput;

/**
 * プロダクト更新のコントローラークラス
 */
class UpdateProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param UpdateProductUsecaseInterface $usecase
     */
    public function __construct(
        private UpdateProductUsecaseInterface $usecase,
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
        $usecaseInput = $this->toUsecaseInput($request);
        $usecaseOutput = $this->usecase->execute($usecaseInput);
        return $this->toResponse($usecaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param UpdateProductRequest $request
     * @return UpdateProductUsecaseInput
     */
    private function toUsecaseInput(UpdateProductRequest $request): UpdateProductUsecaseInput
    {
        /** @var int $id */
        $id = $request->route('id');

        return new UpdateProductUsecaseInput(
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
     * @param UpdateProductUsecaseOutput $usecaseOutput
     * @return JsonResponse
     */
    private function toResponse(UpdateProductUsecaseOutput $usecaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($usecaseOutput));
    }
}
