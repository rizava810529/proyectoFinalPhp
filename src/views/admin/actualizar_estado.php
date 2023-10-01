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

    // Verificar si se recibieron datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el ID de usuario y el nuevo estado del formulario
        $usuario_id = $_POST["usuario_id"];
        $nuevo_estado = $_POST["nuevo_estado"];

        // Actualizar el estado del usuario en la base de datos
        $sql = "UPDATE usuarios SET estado = :nuevo_estado WHERE usuario_id = :usuario_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nuevo_estado", $nuevo_estado, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redireccionar a la página de permisos después de la actualización
        header("Location: dashboard.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
