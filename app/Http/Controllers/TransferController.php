<?php

namespace App\Http\Controllers;

use App\Rules\UserCanTransfer;
use App\Rules\UserHasBalance;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * @OA\Info(title=APP_NAME, version=APP_VERSION)
 * @OA\Server(url=APP_HOST)
 */
class TransferController extends Controller
{
    /**
     * @var TransferService
     */
    private $transferService;

    /**
     * Create a new controller instance
     * 
     * @param TransferService $transferService
     *
     * @return void
     */
    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    /**
     * @OA\Post(
     *      path="/api/transfer",
     *      tags={"Transfer"},
     *      description="Used to transfer money between users",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"value","payer","payee"},
     *                  @OA\Property(
     *                      property="value",
     *                      type="number"
     *                  ),
     *                  @OA\Property(
     *                      property="payer",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="payee",
     *                      type="integer"
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Transfer created",
     *          @OA\JsonContent(ref="#/components/schemas/Transfer")
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Please send required fields",
     *      ),
     *      @OA\Response(
     *          response="500", 
     *          description="Whoops, we had a problem",
     *      )
     * )
     */
    public function create(Request $request)
    {
        $this->validateCreateRequest($request);

        try {
            $transfer = $this->transferService->create($request->all());
            if($transfer) {
                return response()->json(
                    $transfer,
                    JsonResponse::HTTP_CREATED
                );
            }
        } catch (Exception | Throwable $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    private function validateCreateRequest(Request $request)
    {
        $this->validate($request, [
            'value' => [
                'bail',
                'required',
                'numeric',
                'min:0.01'
            ],
            'payer' => [
                'bail',
                'required',
                'int',
                'exists:users,id',
                new UserCanTransfer,
                new UserHasBalance($request->input('value') ?? 0)
            ],
            'payee' => [
                'bail',
                'required',
                'int',
                'exists:users,id'            
            ],
        ]);
    }
}
