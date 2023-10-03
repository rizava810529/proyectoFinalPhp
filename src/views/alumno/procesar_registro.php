<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];
    $fechaNacimiento = $_POST["fecha_nacimiento"];
    $materias = isset($_POST["materias"]) ? $_POST["materias"] : array();

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto_final";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Insertar los datos del usuario en la tabla "usuarios"
    $sql = "INSERT INTO usuarios (correo, contrasena, usuario_nombre, apellido, direccion, fecha_nacimiento) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $correo, $contrasena, $nombre, $apellido, $direccion, $fechaNacimiento);

    if ($stmt->execute()) {
        // Obtener el ID del usuario recién registrado
        $usuarioId = $stmt->insert_id;

        // Insertar las materias seleccionadas en la tabla "usuarios_materias" (si es una tabla de relación)
        foreach ($materias as $materiaId) {
            $sql = "INSERT INTO usuarios_materias (usuario_id, materia_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $usuarioId, $materiaId);
            $stmt->execute();
        }

        // Redirigir al usuario al dashboard después del registro exitoso
        header("Location: dashboard.php");
        exit; // Asegura que no se ejecute más código después de la redirección
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $conn->close();
} else {
    echo "Acceso denegado.";
}
?>
