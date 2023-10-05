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
        $usuario_id = $_GET['id'];
        
        // Consulta la base de datos para obtener los datos del usuario con el ID dado
        $consulta = "SELECT * FROM usuarios WHERE usuario_id = ?";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([$usuario_id]);
        
        // Verifica si se encontró el usuario
        if ($stmt->rowCount() === 1) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Procesa el formulario cuando se envíe
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Recopila los datos actualizados del formulario
                $nuevo_nombre = $_POST['nombre'];
                $nueva_fecha_nacimiento = $_POST['fecha_nacimiento'];
                $nuevo_correo = $_POST['correo'];
                $nueva_direccion = $_POST['direccion'];
                $nuevo_rol = $_POST['rol'];
                
                // Realiza la actualización en la base de datos
                $actualizacion = "UPDATE usuarios SET 
                    usuario_nombre = :nombre,
                    fecha_nacimiento = :fecha_nacimiento,
                    correo = :correo,
                    direccion = :direccion,
                    rol = :rol
                    WHERE usuario_id = :id";
                    
                $stmt = $pdo->prepare($actualizacion);
                $stmt->bindParam(':nombre', $nuevo_nombre);
                $stmt->bindParam(':fecha_nacimiento', $nueva_fecha_nacimiento);
                $stmt->bindParam(':correo', $nuevo_correo);
                $stmt->bindParam(':direccion', $nueva_direccion);
                $stmt->bindParam(':rol', $nuevo_rol);
                $stmt->bindParam(':id', $usuario_id);
                $stmt->execute();
                
                // Redirige al usuario de vuelta al dashboard después de actualizar
                header('Location: dashboard.php'); // Reemplaza con la URL de tu dashboard
                exit(); // Asegura que no se procese más código después de la redirección
            }
            
            // Muestra el formulario de edición con los datos actuales del usuario
            ?>
            <form method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $fila['usuario_nombre']; ?>" required>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento']; ?>" required>
                <label for="correo">Correo:</label>
                <input type="text" name="correo" value="<?php echo $fila['correo']; ?>" required>
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" value="<?php echo $fila['direccion']; ?>" required>
                <label for="rol">Rol:</label>
                <input type="text" name="rol" value="<?php echo $fila['rol']; ?>" required>
                <input type="submit" value="Actualizar">
            </form>
            <?php
        } else {
            echo "No se encontró ningún usuario con el ID proporcionado.";
        }
    } else {
        echo "ID de usuario no válido.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o consulta: " . $e->getMessage();
}
?>
