<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtToken
{
    public static function generateToken($payload)
    {
        $key = 'your_secret_key';
        $algorithm = 'HS256'; 
        $token = JWT::encode($payload, $key, $algorithm);
        return $token;
    }

    public static function validateToken($token)
    {
        try {
            $secretKey = 'your_secret_key';
            $algorithm = 'HS256';  
            $decoded = JWT::decode($token, new Key($secretKey,  $algorithm)); 
     
            return $decoded; 
        } catch (\Exception $e) {
            return null;
        }
    }
}