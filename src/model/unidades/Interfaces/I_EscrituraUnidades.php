<?php

interface I_EscrituraUnidades {
    public function insertarUnidad($claveMateria, $numeroUnidad);
    public function actualizarUnidad($materia);
    public function eliminarUnidad($claveMateria);
}

?>