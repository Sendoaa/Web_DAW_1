<?php
// Definir usuarios
$usuarios = array(
    "admin" => "12345",
    "invitado" => "12345",
    // Agrega más usuarios según sea necesario
);

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el usuario existe y la contraseña es correcta
    if (array_key_exists($nombre, $usuarios) && $usuarios[$nombre] == $contraseña) {
        // Iniciar sesión (puedes implementar esto según tus necesidades)
        session_start();
        $_SESSION['nombre'] = $nombre;
        // Redireccionar a la página de inicio o cualquier otra página protegida
        header("Location: ../index.php");
        exit;
    } else {
        // Mostrar un mensaje de error si el usuario o la contraseña son incorrectos
        echo "<script>alert('Nombre de usuario o contraseña incorrectos');</script>";
    }

    session_start();
if (!isset($_SESSION['nombre'])) {
    // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

}

// Verificar si el usuario no es ni administrador ni invitado
if (!$esAdmin && !$esInvitado) {
    echo "<script>alert('Acceso no autorizado'); window.location.href = '../paginas/login.html';</script>";
  }

?>