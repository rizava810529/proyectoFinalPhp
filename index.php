

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
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <link href="index.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div style="width: 800px; height:auto; " class="m-5 d-flex flex-column">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 gap-5">
                        <div class="card  line">
                            <div class="card-body">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="form-group m-3 inputDiv ">
                                        <img src="../../asset/correo.png" alt="" style="width: 20px; height: 20px; ">
                                        <input type="correo" name="correo" id="correo" class="form-control texto4"
                                            placeholder="correo" required>
                                    </div>
                                    <div class="form-group m-3 inputDiv">
                                        <img src="../../asset/candado.png" alt="" style="width: 20px; height: 20px; ">
                                        <input type="contrasena" name="contrasena" id="contrasena"
                                            placeholder="contrasena" class="form-control texto4" required>
                                    </div>
                                    <!-- Agregamos el campo de selección de rol -->
                                    <p>Haz clic para seleccionar tu rol</p>
                                    <div class="form-group m-3 inputDiv">
                                        <select name="rol" id="role_id" class="form-control texto4" required>
                                            <!-- <option value="admin">Admin</option> -->
                                           
                                            <option value="maestro">maestro</option>
                                            <option value="alumno">Alumno</option> <!-- Cambiamos "estudiante" a "alumno" -->
                                        </select>
                                    </div>
                                    <div class="text-center m-3">
                                        <button type="submit" class="btn btn-primary btn-block texto4">Iniciar sesión</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 900px; height:auto; " class="contenido">
        <div class=" d-flex justify-content-center align-items-center texto4">
            <p>¿Ya eres miembro? <a href="/src/models/login_view.php">Iniciar sesión</a></p>
        </div>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>
