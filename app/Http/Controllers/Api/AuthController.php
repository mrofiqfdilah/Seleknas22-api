<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Societies;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $check = Societies::where('id_card_number', $request->id_card_number)->where('password', $request->password)->first();

        if ($check) {
            $token = md5($check->id_card_number);
            $check->update(['login_tokens' => $token]);
            
            return response()->json([
                'name' => $check->name,
                'born_date' => $check->born_date,
                'gender' => $check->gender,
                'address' => $check->address,
                'token' => $token,
                'regional' => $check->regional->toArray()
            ], 200);
        }

        return response()->json([
        'message' => 'ID Card Number or Password incorrect'
        ], 401);
       
    }

    public function logout(Request $request)
    {
        $token = $request->input('token');
        $checktoken = Societies::where('login_tokens', $token)->first();

        if(!$checktoken || !$token)
        {
            return response()->json([
            'message' => 'Invalid token'
            ], 401);
        }

        $checktoken->update([
            'login_tokens' => null
        ]);

        return response()->json([
        'message' => 'Logout success'
        ], 200);
    }
}
