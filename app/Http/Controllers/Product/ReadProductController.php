<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReadProductRequest;
use Illuminate\Http\JsonResponse;
use Packages\UseCase\Product\Read\ReadProductUseCaseInput;
use Packages\UseCase\Product\Read\ReadProductUseCaseInterface;
use Packages\UseCase\Product\Read\ReadProductUseCaseOutput;

/**
 * プロダクト取得のコントローラークラス
 */
class ReadProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param ReadProductUseCaseInterface $useCase
     */
    public function __construct(
        private ReadProductUseCaseInterface $useCase,
    ) {
    }

    /**
     * プロダクトを取得する
     * TODO: OpenAPIのリクエストスキーマと一致させる方法を検討
     *
     * @param ReadProductRequest $request
     * @return JsonResponse
     */
    public function read(ReadProductRequest $request): JsonResponse
    {
        $useCaseInput = $this->toUseCaseInput($request);
        $useCaseOutput = $this->useCase->execute($useCaseInput);
        return $this->toResponse($useCaseOutput);
    }

    /**
     * リクエストをユースケースインプットに変換する
     *
     * @param ReadProductRequest $request
     * @return ReadProductUseCaseInput
     */
    private function toUseCaseInput(ReadProductRequest $request): ReadProductUseCaseInput
    {
        /** @var int $id */
        $id = $request->route('id');
        return new ReadProductUseCaseInput(id: $id);
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param ReadProductUseCaseOutput $useCaseOutput
     * @return JsonResponse
     */
    private function toResponse(ReadProductUseCaseOutput $useCaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($useCaseOutput));
    }
}
