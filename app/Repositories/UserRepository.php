<?php  

namespace App\Repositories;

use App\Models\User;

class UserRepository 
{
    public function getAllUsers() {
        return User::all();
    }

    public function storeNewUser(array $data) {
        return User::create($data);
    }
}
