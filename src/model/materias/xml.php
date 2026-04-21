<?php

function arrayToXml($data, $xmlData)
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            // Si es un sub-arreglo, crea un nodo y vuelve a llamar a la función
            $subnode = $xmlData->addChild($key);
            arrayToXml($value, $subnode);
        } else {
            // Si es un valor, añade el nodo hijo
            $xmlData->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

// --- Uso ---
$miArreglo = [
    'empresa' => 'Tecnología S.A.',
    'empleado' => [
        'nombre' => 'Juan',
        'edad' => '30',
        'puesto' => 'Desarrollador'
    ]
];

function arrayXml($miArreglo)
{
    // Iniciar con un nodo raíz
    $xml = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
    arrayToXml($miArreglo, $xml);

    // Imprimir o guardar el XML
    echo $xml->asXML();
}
?>