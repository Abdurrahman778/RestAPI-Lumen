<?php

namespace App\Http\Controllers;

use App\Http\Requests\InboundStuffRequest;
use App\Http\Resources\InboundStuffResource;
use App\Services\InboundStuffService;
use App\Services\StuffStockService;
use Illuminate\Http\Request;
class InboundStuffController extends Controller
{
    private $inboundStuffService, $stuffStockService;

    public function __construct(InboundStuffService $inboundStuffService, stuffStockService $stuffStockService)
    {
        $this->inboundStuffService = $inboundStuffService;
        $this->stuffStockService = $stuffStockService;
    }

    public function store(Request $request)
    {
        try {
            $payload = InboundStuffRequest::validate($request);
            $inboundStuff = $this->inboundStuffService->store($request);
            $stuffStock = $this->stuffStockService->update($payload);
            return response()->json(new InboundStuffResource($inboundStuff), 201);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $inboundStuff = $this->inboundStuffService->delete($id);
            return response()->json(new InboundStuffResource($inboundStuff),200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
