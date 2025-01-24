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
        $rules = [
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6',
            'email' => 'required|email',
            'role' => 'required|in:admin,staff', // cara lain yang bisa digunakan, hanya admin dan staff yang dapat diisi
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
