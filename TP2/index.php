<?php
require_once __DIR__ . "./vendor/autoload.php";

require_once './clases/User.php';
require_once './clases/helper.php';
require_once './clases/AuthJwt.php';

$path_info = $_SERVER['PATH_INFO'] ?? NULL;
$request_method = $_SERVER['REQUEST_METHOD'] ?? NULL;
$message = '';
$success = false;


if (isset($request_method) && isset($path_info)) {
    if ($request_method == 'POST') {
        switch ($path_info) {
            case '/signin':
                if (User::isValidUser($_POST)) {

                    $userFound = User::getUser('email', $_POST['email']);
                    if (isset($userFound)) {
                        $message = " Email ya registrado";
                    } else {
                        $user = new User($_POST);
                        $success = helper::guardarEnArchivo('./archivos/users.json', $user);
                        $message = $success ? "User registrado exitosamente" : "Error registrando el User";
                    }
                }
                break;
            case '/login':
                $email = $_POST['email'] ?? NULL;
                $clave = $_POST['clave'] ?? NULL;
                if (isset($email) && isset($clave)) {
                    //Devuelve el User si existe, o NULL en su defecto
                    $user = User::getUser('email', $email);
                    if (isset($user)) {
                        if (User::validateCredentials($email, $clave, $user) == true) {
                            $message = AuthJwt::generarJWT($user);
                            $success = true;
                        } else {
                            $message = "Clave incorrecta";
                        }
                    } else {
                        $message = "User no existe";
                    }
                } else {
                    $message = "Nombre o clave Vacios";
                }
                break;
            default:
                $message = "Ruta invalida";
        }
    } else if ($request_method == 'GET') {
        switch ($path_info) {
            case '/detalle':
                $usuario = AuthJwt::validarJWT();
                if (isset($usuario)) {

                    $message = $usuario;
                    $success = true;
                }
                $message = $success ? $message : 'Error obteniendo el detalle del usuario,(Credenciales Invalidas)';
                break;
            case '/lista':
                $usuario = AuthJwt::validarJWT();

                if (isset($usuario)) {
                    $esAdmin = $usuario->tipo == 'admin';
                    $message = User::listarUsuarios($esAdmin);
                    $success = true;
                }
                $message = $success ? $message : 'Error obteniendo el listado usuario,(Credenciales Invalidas)';
                break;

            default:
                $message = "Ruta invalida";
        }
    } else {
        $message = "Metodo no permitido";
    }
} else {
    $message = "Peticion invalida";
}

echo helper::formatResponse($message, $success);