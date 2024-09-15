<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReadProductRequest;
use Illuminate\Http\JsonResponse;
use Packages\Usecase\Product\Read\ReadProductUsecaseInput;
use Packages\Usecase\Product\Read\ReadProductUsecaseInterface;
use Packages\Usecase\Product\Read\ReadProductUsecaseOutput;

/**
 * プロダクト取得のコントローラークラス
 */
class ReadProductController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param ReadProductUsecaseInterface $usecase
     */
    public function __construct(
        private ReadProductUsecaseInterface $usecase,
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
        $usecaseInput = $this->toUsecaseInput($request);
        $usecaseOutput = $this->usecase->execute($usecaseInput);
        return $this->toResponse($usecaseOutput);
    }

    /**
     * リクエストをコマンドクラスに変換する
     *
     * @param ReadProductRequest $request
     * @return ReadProductUsecaseInput
     */
    private function toUsecaseInput(ReadProductRequest $request): ReadProductUsecaseInput
    {
        /** @var int $id */
        $id = $request->route('id');
        return new ReadProductUsecaseInput(id: $id);
    }

    /**
     * DTOをレスポンスに変換する
     *
     * @param ReadProductUsecaseOutput $usecaseOutput
     * @return JsonResponse
     */
    private function toResponse(ReadProductUsecaseOutput $usecaseOutput): JsonResponse
    {
        return response()->json(get_object_vars($usecaseOutput));
    }
}
