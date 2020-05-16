<?php
include_once("Persona.php");

class Profesor extends Persona
{
    private $_salario;

    public function __construct($nombre, $edad, $direccion, $salario)
    {
        parent::__construct($nombre, $edad, $direccion);
        $this->_salario = $salario;
    }

    public function getSalario()
    {
        return $this->_salario;
    }

    public function setSalario($salario)
    {
        $this->_salario = $salario;
    }

    public function mostrarInfo()
    {
        parent::mostrarInfo();
        echo "Salario: $ " . $this->getSalario() . "<br><br>";
    }
}