<?php


class User
{
    public $email;
    public $clave;
    public $nombre;
    public $apellido;
    public $telefono;
    public $tipo;
    public static $path = './archivos/users.json';


    public function __construct($object)
    {
        $this->email = $object['email'];
        $this->clave = $object['clave'];
        $this->nombre = $object['nombre'];
        $this->apellido = $object['apellido'];
        $this->telefono = $object['telefono'];
        $this->tipo = $object['tipo'];
    }


    public static function isValidUser($request)
    {

        $props = ['email', 'clave', 'nombre', 'apellido', 'telefono', 'tipo'];

        foreach ($props as $key => $prop)
            if (!isset($request[$prop]))
                return false;

        $tipo = $request['tipo'];
        if ($tipo != 'user' && $tipo != 'admin') return false;

        return true;
    }


    public static function getUser($prop, $dato)
    {

        $data = helper::leerArchivo(self::$path);

        foreach ($data as $key => $user)
            if (isset($user[$prop]) && $user[$prop] == $dato)
                return $user;

        return NULL;
    }

    public static function validateCredentials($email, $clave, $user)
    {
        return $user['email'] == $email && $user['clave'] == $clave;;
    }


    public static function listarUsuarios($esAdmin)
    {
        $usuarios = helper::leerArchivo(self::$path);
        $arr = [];

        if (empty($usuarios)) {
            return '[]';
        } else {
            if ($esAdmin) {
                return $usuarios;
            } else {
                foreach ($usuarios as $key => $usuario) {
                    if ($usuario['tipo'] == 'user') {
                        array_push($arr, $usuario);
                    }

                }
            }
        }

        return $arr;
    }

}