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
        $materia_id = $_GET['id']; // Obtiene el ID de la materia desde la URL

        // Elimina los registros relacionados en la tabla usuarios
        $sqlEliminarUsuarios = "DELETE FROM usuarios WHERE materia_id = ?";
        $stmtEliminarUsuarios = $pdo->prepare($sqlEliminarUsuarios);
        $stmtEliminarUsuarios->execute([$materia_id]); // Pasa el valor real como un arreglo

        // Luego, elimina la materia de la base de datos
        $sqlEliminarMateria = "DELETE FROM materias WHERE id = ?";
        $stmtEliminarMateria = $pdo->prepare($sqlEliminarMateria);
        $stmtEliminarMateria->execute([$materia_id]);

        // Redirige al usuario de vuelta al dashboard después de eliminar
        header('Location: dashboard.php'); // Reemplaza con la URL de tu dashboard
        exit(); // Asegura que no se procese más código después de la redirección
    } else {
        echo "ID de materia no válido.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o eliminación: " . $e->getMessage();
}
?>
