<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una nueva materia si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'])) {
        $nombreMateria = $_POST['nombre'];
        $sql = "INSERT INTO materias (nombre) VALUES (:nombre)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombreMateria, PDO::PARAM_STR);
        $stmt->execute();
        echo "Materia creada exitosamente.";
    }

    // Consulta SQL para obtener todas las materias
    $sql_materias = "SELECT * FROM materias";
    $stmt_materias = $pdo->prepare($sql_materias);
    $stmt_materias->execute();
    $materias = $stmt_materias->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>