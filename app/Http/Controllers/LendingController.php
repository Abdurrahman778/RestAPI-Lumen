<?php

namespace App\Http\Controllers;

use App\Http\Requests\LendingRequest;
use App\Http\Resources\LendingResource;
use App\Services\LendingService;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    private $lendingService;

    public function __construct(LendingService $lendingService){
        $this->lendingService = $lendingService;
    }

    public function store(Request $request) {
        try {
            $payload = LendingRequest::validate($request);

            $checkStock = $this->lendingService->check($payload);
            if(is_null($checkStock)){
                $lending = $this->lendingService->store($payload);
                return response()->json(new LendingResource($lending), 200);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
