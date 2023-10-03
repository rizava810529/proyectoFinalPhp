<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesión</title>
    <link href="index.css" rel="stylesheet" />
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="bg-yellow-100">

    <div class="lg:block h-200px">
        <img src="assets/logo.jpg" alt="">
    </div>

    <div class="w-full max-w-sm mx-auto mt-10 p-4 bg-white rounded shadow-md bg-opacity-90">
        <h1 class="text-2xl font-bold text-center mb-4">Login</h1>
        <form method="post" action="/src/views/login.php">
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Correo electrónico:</label>
                <input type="email" id="email" name="correo" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
            <div class="mb-4">
                <label for="contrasena" class="block text-gray-600">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-gray-600">Selecciona tu rol:</label>
                <select id="rol" name="rol" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="admin">Admin</option>
                    <option value="profesor">Profesor</option>
                    <option value="estudiante">Alumno</option>
                </select>
            </div>
            <div class="text-center mb-4">
                <input type="submit" value="Iniciar sesión"
                    class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            </div>
        </form>
        <div class="text-center">
            <p class="text-gray-600">Regresar a <a href="/index.php" class="text-blue-500 hover:underline">Crear
                    Usuario</a></p>
        </div>
    </div>
</body>

</html>
