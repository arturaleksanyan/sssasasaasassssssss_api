<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\ResponseHelper;
use App\Helpers\JwtToken; 



class AuthController extends Controller
{
    public function getProfile(Request $request)
    {
           
        try {
            $id = $request->user_info->id; 

            $data = User::find($id);

            return ResponseHelper::success($data, 200);
        } catch (\Exception $e) {
             return ResponseHelper::error( $e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');
       
            if (Auth::attempt($credentials)) {

                $admin = Auth::user();

                $token = JwtToken::generateToken(['id' => $admin->id, 'type' => 'admin']);

                return ResponseHelper::success(['token' => $token], 200);
            }

            return ResponseHelper::error('Incorrect username or password', 401);
        } catch (\Exception $e) {
            return ResponseHelper::error( $e->getMessage(), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $id = $request->user_info->id; 

            $admin = User::find($id);

            $admin->fill($request->all())->save();

            return ResponseHelper::success("Profile updated", 200);
        } catch (\Exception $e) {
            return ResponseHelper::error( $e->getMessage(), 500);
        }
    }

    public function validateUser(Request $request)
    {
        try {
            $id = $request->user_info->id; 

            $admin = User::find($id);

            if (!$admin) {
                return response()->json(['error' => 'Forbidden'], 403);
            }

            $token = JwtToken::generateToken(['id' => $admin->id, 'type' => 'admin']);

            return ResponseHelper::success( ['token' => $token], 200);
        } catch (\Exception $e) {
            return ResponseHelper::error( $e->getMessage(), 500);
        }
    }
}
