<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre_clase = $_POST["nombre_clase"];
        $maestro_id = $_POST["maestro_id"];
        $materia_id = $_POST["materia_id"];

        $stmt = $pdo->prepare("INSERT INTO clases (nombre_clase, maestro_id, materia_id) VALUES (:nombre_clase, :maestro_id, :materia_id)");
        $stmt->bindParam(':nombre_clase', $nombre_clase);
        $stmt->bindParam(':maestro_id', $maestro_id);
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->execute();

        echo "Clase registrada exitosamente.";
        header("Location: dashboard.php");
exit();
    }

    // Consulta todas las clases registradas
    $consulta = $pdo->query("SELECT * FROM clases");
    $clases = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
