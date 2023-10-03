<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
</head>
<body>
    <h1>Dashboard</h1>
    <?php
    session_start();
    if(isset($_SESSION["user_data"])) {
        $user_data = $_SESSION["user_data"];
        if($user_data["role_id"] === 1){
            echo "<h2>¡Hola admin!</h2>";
            header("Location: /src/views/admin/dashboard.php");
            exit(); // Asegura que la redirección se ejecute y termina la ejecución del script
        }
        if($user_data["role_id"] === 2){
            echo "<h2>¡Hola maestro!</h2>";
            header("Location:/src/views/maestro/dashboard.php");
            exit();
        }
        if($user_data["role_id"] === 3){
            echo "<h2>¡Hola alumno!</h2>";
            header("Location: /src/views/alumno/dashboard.php");
            exit();
        }
    } else {
        // Si el usuario no está autenticado, puedes redirigirlo a la página de inicio de sesión
        header("Location: /index.php");
        exit();
    }
    ?>
</body>
</html>
