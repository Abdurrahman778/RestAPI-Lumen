<?php 

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class LendingRequest {
    public static function validate(Request $request) {
        $request['notes'] = $request->notes ?? null;    

        $rules = [
            'stuff_id' => 'required',
            'name' => 'required|string',
            'total_stuff' => 'required',
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
