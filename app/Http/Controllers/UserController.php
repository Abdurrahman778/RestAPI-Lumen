<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function me()
    {
        $users = $this->userService->profile();

        return response()->json(new UserResource($users), 200);
    }
    
    public function store(Request $request)
    {
        
        $validatedData = UserRequest::validate($request);

        $user = $this->userService->store($validatedData);

        return response()->json(new UserResource($user), 200);
    }

    public function login(Request $request)
    {
        try {
            $payload = LoginRequest::validate($request);

            $login = $this->userService->login($payload);

            return response()->json($login, 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function logout()
    {
        $this->userService->logout();
        return response()->json("logout berhasil", 200);
    }
}
