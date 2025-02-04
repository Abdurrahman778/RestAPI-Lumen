<?php  

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Factory;

class LoginRequest
{
    // menggunakan static agar pemanggilan menggunakan :: tanpa perlu new
    public static function validate(Request $request)
    {
        $request['role'] = $request->role ?? "staff";

        $rules = [
            'password' => 'required|string|min:6',
            'email' => 'required|email|',
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
