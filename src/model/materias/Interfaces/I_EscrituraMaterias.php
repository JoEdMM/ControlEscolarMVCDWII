<?php

interface I_EscrituraMaterias {
    public function insertarMateria($materia);
    public function actualizarMateria($materia);
    public function eliminarMateria($claveMateria);
}

?>