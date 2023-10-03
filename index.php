<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "proyecto_final";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"]; // Modificamos el nombre del campo de selección de rol

    // Verificar si el correo electrónico ya está registrado
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El correo electrónico ya está registrado, redirigir a login.php
        header("Location: /src/models/login_view.php");
        exit(); // Terminar el script para evitar que siga ejecutándose
    } else {
        // Hash de la contraseña utilizando password_hash()
        $hashed_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos con rol
        $insert_sql = "INSERT INTO usuarios (correo, contrasena, rol) VALUES ('$correo', '$hashed_contrasena', '$rol')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Usuario creado exitosamente";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>crear-usuario</title>

    <link href="index.css" rel="stylesheet" />
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <div class="py-16">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
            <div class="hidden lg:block  h-200">
                <img src="assets/logo.jpg" alt="" srcset="">
            </div>
            <div class="w-full p-8 lg:w-200">
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 lg:w-1/4"></span>
                    <a href="#" class="text-xs text-center text-gray-500 uppercase">WELCOME</a>
                    <span class="border-b w-1/5 lg:w-1/4"></span>
                </div>                
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mx-auto w-3/4 mt-2">
                    <div class="mb-6">
                        <input type="email" name="correo" id="correo" class="w-full p-3 rounded border bg-gray-100"
                            placeholder="Correo" required>
                    </div>
                    <div class="mb-6">
                        <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña"
                            class="w-full p-3 rounded border bg-gray-100" required>
                    </div>
                    <!-- Agregamos el campo de selección de rol -->
                    <p class="mb-2">Haz clic para seleccionar tu rol</p>
                    <div class="mb-6">
                        <select name="rol" id="role_id" class="w-full p-3 rounded border bg-gray-100" required>
                            <!-- <option value="admin">Admin</option> -->
                            <option value="maestro">Maestro</option>
                            <option value="alumno">Alumno</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full">
                            Crear Usuario
                        </button>
                    </div>
                </form>
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 md:w-1/4"></span>
                    <a href="/src/models/login_view.php" class="text-xs text-gray-500 uppercase">or sign up</a>
                    <span class="border-b w-1/5 md:w-1/4"></span>
                </div>
            </div>
        </div>
    </div>
</body>