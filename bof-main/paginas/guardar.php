<?php
// Comprueba si existe el archivo XML
if (file_exists('contacto.xml')) {
    // Carga el archivo XML existente
    $xml = new DOMDocument('1.0', 'utf-8');
    $xml->load('contacto.xml');

    // Obtiene el elemento raíz
    $raiz = $xml->documentElement;

    // Crea el nuevo elemento "envio" para la información del formulario actual
    $nuevoNodo = $xml->createElement('envio');

    // Campos del elemento
    $nombre = $xml->createElement('nombre');
    $nombre->nodeValue = $_POST['nombre'] ?? '';
    $nuevoNodo->appendChild($nombre);

    $apellidos = $xml->createElement('apellidos');
    $apellidos->nodeValue = $_POST['apellidos'] ?? '';
    $nuevoNodo->appendChild($apellidos);

    $correo = $xml->createElement('correo');
    $correo->nodeValue = $_POST['correo'] ?? '';
    $nuevoNodo->appendChild($correo);

    $mensaje = $xml->createElement('mensaje');
    $mensaje->nodeValue = $_POST['mensaje'] ?? '';
    $nuevoNodo->appendChild($mensaje);

    // Agrega el nuevo elemento "envio" al elemento raíz
    $raiz->appendChild($nuevoNodo);

    // Guarda el archivo XML actualizado
    $xml->save('contacto.xml');
     // Redirige a la página de confirmación
     header('Location: ../paginas/contacto.html?enviado=true');
     exit;
} else {
    // Si el archivo XML no existe, crea uno nuevo con el primer formulario

    // Crea un nuevo documento XML
    $xml = new DOMDocument('1.0', 'utf-8');

    // Crea el elemento raíz
    $raiz = $xml->createElement('formulario');
    $xml->appendChild($raiz);

    // Crea el primer elemento "envio" con los datos del formulario
    $nuevoNodo = $xml->createElement('envio');

    // Campos del elemento
    $nombre = $xml->createElement('nombre');
    $nombre->nodeValue = $_POST['nombre'] ?? '';
    $nuevoNodo->appendChild($nombre);

    $apellidos = $xml->createElement('apellidos');
    $apellidos->nodeValue = $_POST['apellidos'] ?? '';
    $nuevoNodo->appendChild($apellidos);

    $correo = $xml->createElement('correo');
    $correo->nodeValue = $_POST['correo'] ?? '';
    $nuevoNodo->appendChild($correo);

    $mensaje = $xml->createElement('mensaje');
    $mensaje->nodeValue = $_POST['mensaje'] ?? '';
    $nuevoNodo->appendChild($mensaje);

    // Agrega el nuevo elemento "envio" al elemento raíz
    $raiz->appendChild($nuevoNodo);

    // Guarda el archivo XML
    $xml->save('contacto.xml');

    // Redirige a la página de confirmación
    header('Location: ../paginas/contacto.html?enviado=true');
    exit;
}