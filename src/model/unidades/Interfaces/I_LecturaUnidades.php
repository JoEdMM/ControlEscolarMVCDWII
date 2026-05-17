<?php

interface I_LecturaUnidades {
    public function obtenerUnidades($claveMateria);
    public function obtenerUnidadesporClave($claveMateria);

    public function obtenerUnidadesporClaveNum($claveMateria, $numUnidad);
}

?>