<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "proyecto_final";

        // Crear una conexión PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        // Establecer el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recupera el nombre de la materia desde el formulario
        $nombreMateria = $_POST['nombreMateria'];

        // Inserta la nueva materia en la base de datos
        $sqlInsertarMateria = "INSERT INTO materias (nombre) VALUES (?)";
        $stmtInsertarMateria = $pdo->prepare($sqlInsertarMateria);
        $stmtInsertarMateria->execute([$nombreMateria]);

        // Redirige al usuario de vuelta al dashboard después de crear la materia
        header('Location: dashboard.php'); // Reemplaza con la URL de tu dashboard
        exit(); // Asegura que no se procese más código después de la redirección
    } catch (PDOException $e) {
        echo "Error en la conexión o inserción: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Título, metadatos y estilos CSS -->
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Crear Nueva Materia</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombreMateria">
                    Nombre de la Materia
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombreMateria" name="nombreMateria" type="text" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Crear Materia
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="dashboard.php">Volver al Dashboard</a>
            </div>
        </form>
    </div>
</body>
</html>
