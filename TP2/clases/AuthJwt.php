<?php

require_once './clases/User.php';
use \Firebase\JWT\JWT;

class AuthJwt
{
    private static $key = "trabajo-practico";
    private static $payload;

    public static function generarJWT($user){

        AuthJwt::$payload=array(
            'email'=>$user['email'],
            'nombre'=>$user['nombre'],
            'apellido'=>$user['apellido'],
            'tipo'=>$user['tipo']
        );

        return JWT::encode(self::$payload,self::$key);
    }

    public static function validarJWT(){

        $headers = getallheaders();
        $token = $headers['token'] ?? NULL;
        $decoded = null;


        try {
            $decoded = JWT::decode($token, self::$key, array('HS256'));
        } catch (Exception $e) {
            return NULL;
        }

        return $decoded;
    }
}