<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto_final";

    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $clase_id = $_POST["clase_id"];
        $nombre_clase = $_POST["nombre_clase"];
        $maestro_id = $_POST["maestro_id"];
        $materia_id = $_POST["materia_id"];

        // Actualizar la información de la clase en la base de datos
        $stmt = $pdo->prepare("UPDATE clases SET nombre_clase = :nombre_clase, maestro_id = :maestro_id, materia_id = :materia_id WHERE clase_id = :clase_id");
        $stmt->bindParam(':clase_id', $clase_id);
        $stmt->bindParam(':nombre_clase', $nombre_clase);
        $stmt->bindParam(':maestro_id', $maestro_id);
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->execute();

       // Redirige al usuario al dashboard después de guardar los cambios
    header("Location: dashboard.php");
    exit();
    } else {
        // Obtener el ID de la clase a editar desde la URL
        $clase_id = $_GET['id'];

        // Consultar la información de la clase
        $consulta = $pdo->prepare("SELECT * FROM clases WHERE clase_id = :clase_id");
        $consulta->bindParam(':clase_id', $clase_id);
        $consulta->execute();
        $clase = $consulta->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Editar Clase</title>
</head>
<body class="bg-gray-200">
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-semibold mb-3">Editar Clase</h1>
        <form method="post">
            <input type="hidden" name="clase_id" value="<?php echo $clase['clase_id']; ?>">
            <div class="mb-4">
                <label for="nombre_clase" class="block text-gray-700 font-bold mb-2">Nombre de la Clase</label>
                <input type="text" name="nombre_clase" id="nombre_clase" value="<?php echo $clase['nombre_clase']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="maestro_id" class="block text-gray-700 font-bold mb-2">ID del Maestro</label>
                <input type="text" name="maestro_id" id="maestro_id" value="<?php echo $clase['maestro_id']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="materia_id" class="block text-gray-700 font-bold mb-2">ID de la Materia</label>
                <input type="text" name="materia_id" id="materia_id" value="<?php echo $clase['materia_id']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>
</html>
