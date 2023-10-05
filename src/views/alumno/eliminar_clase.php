<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $clase_id = $_GET['id'];

        // Eliminar la clase de la base de datos
        $stmt = $pdo->prepare("DELETE FROM clases WHERE clase_id = :clase_id");
        $stmt->bindParam(':clase_id', $clase_id);
        $stmt->execute();

        // Redirigir al usuario al dashboard después de eliminar la clase
        header("Location: dashboard.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
