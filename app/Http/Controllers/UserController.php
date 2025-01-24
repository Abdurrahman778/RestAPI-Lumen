<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->index();

        return response()->json(UserResource::collection($users), 200);
    }
    
    public function store(Request $request)
    {
        
        $validatedData = UserRequest::validate($request);

        $user = $this->userService->store($validatedData);

        return response()->json(new UserResource($user), 200);
    }
}
