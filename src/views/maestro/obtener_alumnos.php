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
    
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
// Obtén el nombre de la materia seleccionada
$materiaSeleccionada = $_POST["materia"];

// Realiza una consulta para obtener los alumnos de esa materia
$sql = "SELECT usuario_id, usuario_nombre, calificacion
        FROM usuarios
        WHERE rol = 'alumnos' AND materia_id IN (SELECT id FROM materias WHERE nombre = :historia)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":materia", $materiaSeleccionada);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Genera la tabla HTML con los datos de los alumnos
if (!empty($resultados)) {
    foreach ($resultados as $fila) {
        echo "<tr>";
        echo "<td class='py-2 px-4 border'>" . $fila["usuario_id"] . "</td>";
        echo "<td class='py-2 px-4 border'>" . $fila["usuario_nombre"] . "</td>";
        echo "<td class='py-2 px-4 border'>" . $fila["calificacion"] . "</td>";
        echo "<td class='py-2 px-4 border'>";
        // Formulario para enviar calificación y mensaje
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='usuario_id' value='" . $fila["usuario_id"] . "'>";
        echo "<input type='number' name='calificacion' placeholder='Calificación' class='w-16 px-2 py-1 border border-gray-300 rounded-md'>";
        echo "<textarea name='mensaje' placeholder='Mensaje' class='w-full mt-2 px-2 py-1 border border-gray-300 rounded-md'></textarea>";
        echo "<button type='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-2'>Enviar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    // Si no hay resultados, muestra una fila de tabla con un mensaje
    echo "<tr><td colspan='4' class='py-2 px-4 border text-center'>No se encontraron alumnos en esta materia.</td></tr>";
}
?>
