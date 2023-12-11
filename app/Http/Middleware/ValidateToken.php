<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Helpers\JwtToken; 
use App\Helpers\ResponseHelper;

class ValidateToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken(); 

        if (!$token) {
            return ResponseHelper::error( "Forbidden", 500);
        }

        $decoded = JwtToken::validateToken($token); 

        if (!$decoded) {
            return ResponseHelper::error( "Forbidden", 500);
        }

        $request->user_info = $decoded;
       
        return $next($request);
      
    }
}
