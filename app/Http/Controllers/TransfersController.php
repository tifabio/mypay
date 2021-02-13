<?php

namespace App\Http\Controllers;

use App\Rules\UserCanTransfer;
use App\Rules\UserHasBalance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function save(Request $request)
    {
        $this->validateSaveRequest($request);

        return response()->json(
            [],
            JsonResponse::HTTP_CREATED
        );
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
