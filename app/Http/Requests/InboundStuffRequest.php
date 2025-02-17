<?php  

namespace App\Http\Requests;

use Illuminate\Validation\Factory;
use Illuminate\Http\Request;

class InboundStuffRequest
{
    // menggunakan static agar pemanggilan menggunakan :: tanpa perlu new
    public static function validate(Request $request)
    {
        $rules = [
            'stuff_id' => 'required',
            'total' => 'required',
            'proof_file' => 'required|image',
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
