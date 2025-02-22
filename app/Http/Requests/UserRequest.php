<?php  

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Factory;

class UserRequest
{
    // menggunakan static agar pemanggilan menggunakan :: tanpa perlu new
    public static function validate(Request $request)
    {
        $request['role'] = $request->role ?? "staff";

        $rules = [
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6',
            'email' => 'required|email|',
            'role' => 'required|in:' . implode(',',[
                User::ADMIN, 
                User::STAFF
            ]),
        ];
        
        $validator = app(Factory::class)->make($request->all(), $rules);

        if ($validator->fails()) {
            response()->json($validator->errors(), 400)->send();
            exit;
        } else {
            return $validator->validated();
        }
        
    }
}
