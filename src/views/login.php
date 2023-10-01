<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
    $query = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([$correo, $contrasena]);
        if ($stmt->rowCount() === 1) {
            $_SESSION["user_data"] = $stmt->fetch(PDO::FETCH_ASSOC);
            header("location: /src/views/dashboard.php");
        } else {
            echo "El correo o la contraseña son incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
