<?php
include_once("./interfaces/Imetodos.php");

use NNV\RestCountries;

abstract class Persona implements Imetodos
{
    private $_nombre;
    private $_edad;
    public $_direccion;

    public function __construct($_nombre, $_edad, $_direccion)
    {
        $this->_nombre = $_nombre;
        $this->_edad = $_edad;
        $this->_direccion = $_direccion;
    }


    public function getNombre()
    {
        return $this->_nombre;
    }

    public function getEdad()
    {
        return $this->_edad;
    }


    public function setDireccion($direccion)
    {
        $this->_direccion = $direccion;
    }

    public function getDireccion()
    {
        return $this->_direccion;
    }


    public function mostrarInfo()
    {
        echo "Nombre: " . $this->getNombre() . "<br>";
        echo "Edad: " . $this->getEdad() . "<br>";
        echo "Direccion: " . $this->getDireccion() . "<br>";

    }

    public static function AsignarCapital($paisOrig)
    {
        $restCountries = new RestCountries;
        $pais = $restCountries->fields(["name", "capital", "region", "currencies", "population"])->byName($paisOrig);
        $capital="";
        foreach($pais as $value){
            $capital = $value->capital;
        }
        return $capital;
    }

}