<?php
try {
    // Configura la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesar el formulario de edición de materia
        $nombreMateria = $_POST["nombre"];
        $materiaID = $_POST["materia_id"];

        // Consulta SQL para actualizar el nombre de la materia
        $sql = "UPDATE materias SET nombre = :nombre WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nombre", $nombreMateria, PDO::PARAM_STR);
        $stmt->bindParam(":id", $materiaID, PDO::PARAM_INT);
        $stmt->execute();

        // Redireccionar al dashboard
        header("Location: dashboard.php");
        exit();
    }

    // Si no se recibió un ID de materia válido, muestra un mensaje de error
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        echo "ID de materia no válido.";
        exit();
    }

    // Obtener el ID de la materia de la URL
    $materiaID = $_GET["id"];

    // Consulta SQL para obtener la información de la materia
    $sql = "SELECT * FROM materias WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $materiaID, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los datos de la materia
    $materia = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-4">
        <h2 class="text-2xl font-bold mb-4">Editar Materia</h2>
        <form method="post" action="editar_materia.php">
            <input type="hidden" name="materia_id" value="<?= $materia["id"] ?>">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold">Nombre de la Materia:</label>
                <input type="text" name="nombre" id="nombre" value="<?= $materia["nombre"] ?>" required
                       class="w-full border-2 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <input type="submit" value="Guardar Cambios"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            </div>
        </form>
    </div>
</body>

</html>
