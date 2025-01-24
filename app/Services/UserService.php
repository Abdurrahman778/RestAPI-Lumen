<?php 

namespace App\Services;

use App\Repositories\UserRepository;
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
}
