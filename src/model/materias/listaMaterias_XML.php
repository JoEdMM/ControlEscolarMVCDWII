<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
require_once(BASE_PATH . '/src/model/materias/xml.php');
class listaMaterias_XML
{
    public $conexion;
    public function __construct()
    {
        $this->conexion = Db::conectar();
    }

    public function mostrarXML()
    {
        $listaMaterias = [];

        $select = $this->conexion->query('SELECT * FROM materias');


        foreach ($select->fetchall(PDO::FETCH_ASSOC) as $materia) {

            $listaMaterias[] = $materia;
        }

        $XmlListaMaterias = arrayXml($listaMaterias);
        //print_r($XmlListaMaterias);
        return $XmlListaMaterias;
    }
}
