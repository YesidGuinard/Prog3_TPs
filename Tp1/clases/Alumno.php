<?php
include_once("Persona.php");

class Alumno extends Persona
{
    private $_legajo;

    public function __construct($nombre, $edad, $direccion, $legajo)
    {
        parent::__construct($nombre, $edad, $direccion);
        $this->_legajo = $legajo;
    }


    public function getLegajo()
    {
        return $this->_legajo;
    }


    public function setLegajo($legajo)
    {
        $this->_legajo = $legajo;
    }

    public function mostrarInfo()
    {
        parent::mostrarInfo();
        echo "Legajo: " . $this->getLegajo() . "<br><br>";
    }


}