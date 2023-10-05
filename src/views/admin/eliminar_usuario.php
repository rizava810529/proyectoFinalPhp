<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $usuario_id = $_GET['id'];

        // Eliminar los mensajes relacionados antes de eliminar al usuario
        $consulta_eliminar_mensajes = "DELETE FROM mensajes WHERE usuario_id = ?";
        $stmt_eliminar_mensajes = $pdo->prepare($consulta_eliminar_mensajes);
        $stmt_eliminar_mensajes->execute([$usuario_id]);

        // Luego puedes eliminar al usuario
        $consulta_eliminar_usuario = "DELETE FROM usuarios WHERE usuario_id = ?";
        $stmt_eliminar_usuario = $pdo->prepare($consulta_eliminar_usuario);
        $stmt_eliminar_usuario->execute([$usuario_id]);

        // Redirige al usuario de vuelta al dashboard después de eliminar
        header('Location: dashboard.php'); // Reemplaza con la URL de tu dashboard
        exit(); // Asegura que no se procese más código después de la redirección
    } else {
        echo "ID de usuario no válido.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o eliminación: " . $e->getMessage();
}
?>


<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";
    
    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verifica si se proporciona un ID válido en la URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $usuario_id = $_GET['id'];
        
        // Elimina el usuario de la base de datos
        $eliminacion = "DELETE FROM usuarios WHERE usuario_id = ?";
        $stmt = $pdo->prepare($eliminacion);
        $stmt->execute([$usuario_id]);
        
        // Redirige al usuario de vuelta al dashboard después de eliminar
        header('Location: dashboard.php'); // Reemplaza con la URL de tu dashboard
        exit(); // Asegura que no se procese más código después de la redirección
    } else {
        echo "ID de usuario no válido.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o eliminación: " . $e->getMessage();
}
?>
