<?php

namespace App\Http\Controllers;

use App\Http\Resources\StuffResource;
use App\Http\Requests\StuffRequest;
use Illuminate\Http\Request;
use App\Services\StuffService;
class StuffController extends Controller
{
    private $stuffService;

    public function __construct(StuffService $stuffService)
    {
        $this->stuffService = $stuffService;
    }


    public function index()
    {
        try {
            $stuffs = $this->stuffService->index();
            return response()->json(StuffResource::collection($stuffs), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $payload = StuffRequest::validate($request);
            $stuff = $this->stuffService->store($payload);
            return response()->json( new StuffResource($stuff), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payload = StuffRequest::validate($request);
            $stuff = $this->stuffService->update($payload, $id);
            return response()->json( new StuffResource($stuff), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

   public function delete($id)
   {
    try {
        $this->stuffService->destroy($id);
        return response()->json(['message' => 'Stuff deleted successfully'], 200);
    } catch (\Exception $err) {
        return response()->json(['error' => $err->getMessage()], 500);
    }
   }

   public function show($id)
   {
    try {
        $stuffs = $this->stuffService->show($id);
        return response()->json(new StuffResource($stuffs), 200);
    } catch (\Exception $err) {
        return response()->json(['error' => $err->getMessage()], 500);
    }
   }
}
