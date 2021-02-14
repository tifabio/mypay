<?php

namespace App\Http\Controllers;

use App\Rules\UserCanTransfer;
use App\Rules\UserHasBalance;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TransferController extends Controller
{
    /**
     * @var TransferService
     */
    private $transfersService;

    /**
     * Create a new controller instance
     * 
     * @param TransferService $transfersService
     *
     * @return void
     */
    public function __construct(TransferService $transfersService)
    {
        $this->transfersService = $transfersService;
    }

    public function create(Request $request)
    {
        $this->validateSaveRequest($request);

        try {
            $transfer = $this->transfersService->create($request->all());
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

    private function validateSaveRequest(Request $request)
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
                new UserHasBalance($request->input('value'))
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
