<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        return $this->userRepository->getAllUsers();
    }

    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->storeNewUser($data);
    }


    public function login(array $data)
    {
        $token = Auth::attempt($data);
        if (!$token) {
            return response()->json("login gagal", 400)->send();
            exit;
        }

        $responseToken = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::user()
        ];

        return $responseToken;
    }

    public function profile()
    {
        return Auth::user();
    }

    public function logout() {
        return Auth::logout();
    }
}
