<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    public function login(Request $request){
        // validate Request
        $fields = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        // select the user
        $user = User::where('email', $fields['email'])->first();
        // check the creds
        if( !$user || !hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'you must entered wrong creds'
            ], 401);
        }
        if( $user->role == 1){
        $patient = [
            'patient_id' => $user->patient->id,
            'username' => $user->username,
        ];
        
        $token = $user->createToken('logintoken')->plainTextToken;
        $response = [
            'patient' => $patient,
            'token' => $token
        ];
        return response($response, 201);
        }
        else 
            return response(['error'=>'this url is only for doctors'], 403);
        
    }

    // logout method
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return ['message' => 'logout'];

    }
}