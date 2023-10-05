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

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $nombre = $_POST["nombre"];
        $fechaNacimiento = $_POST["fecha_nacimiento"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];

        // Validar los datos (puedes agregar más validaciones según tus necesidades)

        // Preparar la consulta SQL para insertar un nuevo maestro
        $sql = "INSERT INTO usuarios (correo, usuario_nombre, fecha_nacimiento, direccion, rol) VALUES (:correo, :nombre, :fecha_nacimiento, :direccion, 'maestro')";

        // Preparar la declaración SQL
        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
        $stmt->bindParam(':direccion', $direccion);

        // Ejecutar la consulta para agregar al nuevo usuario con rol "maestro"
        if ($stmt->execute()) {
            echo "Maestro agregado exitosamente.";

            // Redirigir al usuario al "dashboard" después de agregar el maestro exitosamente
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error al agregar el maestro: " . $stmt->errorInfo();
        }
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
