<?php
require __DIR__ . '/vendor/autoload.php';
include_once("./clases/Profesor.php");
include_once("./clases/Alumno.php");
echo "<h1>" . "TP1 Yesid Guinard" . "</h1><br>";
$alumno = new Alumno("Yesid", 36, "Av caracas 10", 107293);
$profesor = new Profesor("Mario", 42, "Av. mitre 500", 200000);


$alumno->mostrarInfo();
$profesor->mostrarInfo();
$capitalParaProfe = Persona::AsignarCapital("argentina");
$capitalParaAlumno = Persona::AsignarCapital("colombia");

$alumno->setDireccion($alumno->getDireccion()." ".$capitalParaAlumno);
$profesor->setDireccion($profesor->getDireccion()." ".$capitalParaProfe);

$alumno->mostrarInfo();
$profesor->mostrarInfo();