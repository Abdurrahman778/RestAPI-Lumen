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

    public function updateUser(array $data, $id)
    {
        User::where('id',$id)->update($data);
        return User::find($id);
    }

    public function deleteUser($id)
    {
        return User::where('id',$id)->delete();
    }

}
