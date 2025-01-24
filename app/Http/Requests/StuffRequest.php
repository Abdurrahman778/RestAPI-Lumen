<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Models\Stuff;
use Illuminate\Validation\Factory;
class StuffRequest
{
    // menggunakan static agar pemanggilan menggunakan :: tanpa perlu new
    public static function validate(Request $request)
    {
        // validasi ini agar data yang diisi hanya diantara item array tersebut saja, selain dari itu gabisa
        $rules = [
            'name' => 'required|string|min:3',
            'type' => 'required|in :' . implode(',',[Stuff::HTL_KLN, Stuff::LAB, Stuff::SARPRAS]),
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