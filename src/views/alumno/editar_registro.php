<?php
// error_reporting(E_ALL);

// // Mostrar errores en pantalla (para desarrollo)
// ini_set('display_errors', 1);
// // Registrar errores en un archivo de registro (para producción)
// ini_set('log_errors', 1);
// ini_set('error_log', 'error.log');


// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Recoger los datos del formulario
   $correo = $_POST["correo"];
   $contrasena = $_POST["contrasena"];
   $usuario_nombre = $_POST["usuario_nombre"];
   $apellido = $_POST["apellido"];
   $direccion = $_POST["direccion"];
   $fecha_nacimiento = $_POST["fecha_nacimiento"];
   $materias = $_POST["materias"];
   var_dump($_POST);

   // Conecta a la base de datos
   try {
       $servername = "localhost";
       $username = "root";
       $password = "";
       $database = "proyecto_final";

       // Crear una conexión PDO
       $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

       // Establecer el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       // Actualizar el registro en la tabla usuarios
       $sql = "UPDATE usuarios SET 
               contrasena = :contrasena,
               usuario_nombre = :usuario_nombre,
               apellido = :apellido,
               direccion = :direccion,
               materia = :materia_id,
               fecha_nacimiento = :fecha_nacimiento
               WHERE correo = 'alumno@alumno'";
              
   
        $stmt = $pdo->prepare($sql);
       $stmt->bindParam(":contrasena", $contrasena);// es una medida de seguridad que garantiza que el valor de la contraseña se incluya de manera segura en la consulta SQL sin riesgo de inyección SQL.
        $stmt->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_nombre", $usuario_nombre, PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
       $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();

       // Actualizar las materias asociadas al usuario (pueden ser múltiples)
       $sql = "DELETE FROM usuario_materia WHERE usuario_id = :id";
       $stmt = $pdo->prepare($sql);
    //    session_start()
    // $idUsuario = $_SESSION[""]["id"] 
       $idUsuario = 4;
       $stmt->bindParam(":id", $idUsuario, PDO::PARAM_STR);
       $stmt->execute();

       // Insertar las nuevas materias seleccionadas
       foreach ($materias as $subject) {
           $sql = "INSERT INTO usuario_materia (usuario_id, materia_id) VALUES (:id, :subject)";
           $stmt = $pdo->prepare($sql);
           $stmt->bindParam(":id", $idUsuario, PDO::PARAM_STR);
           $stmt->bindParam(":subject", $subject, PDO::PARAM_INT);
           $stmt->execute();
       }

       // Redirigir a una página de éxito o mostrar un mensaje de éxito
       header("Location: dashboard.php");
       exit();
   } catch (PDOException $e) {
       echo "Error en la conexión a la base de datos: " . $e->getMessage();
   }
}
?>