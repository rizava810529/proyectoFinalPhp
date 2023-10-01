<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>login</h1>
    <form method="post" action="/src/views/login.php">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="correo" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <label for="rol">Selecciona tu rol:</label>
        <select name="rol" required>
            <option value="admin">Admin</option>
            <option value="profesor">Profesor</option>
            <option value="estudiante">alumno</option>
        </select><br>

        <input type="submit" value="Iniciar sesión">
    </form>

    <div class=" d-flex justify-content-center align-items-center texto4">
            <p>Regresar a <a href="/index.php">Crear Usuario</a></p>
        </div>
</body>
</html>
