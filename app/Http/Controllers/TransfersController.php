<?php

namespace App\Http\Controllers;

use App\Rules\UserCanTransfer;
use App\Rules\UserHasBalance;
use App\Services\TransfersService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TransfersController extends Controller
{
    /**
     * @var TransfersService
     */
    private $transfersService;

    /**
     * Create a new controller instance
     * 
     * @param TransfersService $transfersService
     *
     * @return void
     */
    public function __construct(TransfersService $transfersService)
    {
        $this->transfersService = $transfersService;
    }

    public function save(Request $request)
    {
        $this->validateSaveRequest($request);

        try {
            if($saved = $this->transfersService->create($request->all())) {
                return response()->json(
                    $saved,
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
