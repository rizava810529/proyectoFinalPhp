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

    // Consulta SQL para recuperar datos de la base de datos
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
        font-family: karla;
    }

    .bg-sidebar {
        background: #3d68ff;
    }

    .cta-btn {
        color: #3d68ff;
    }

    .upgrade-btn {
        background: #1947ee;
    }

    .upgrade-btn:hover {
        background: #0038fd;
    }

    .active-nav-link {
        background: #1947ee;
    }

    .nav-item:hover {
        background: #1947ee;
    }

    .account-link:hover {
        background: #3d68ff;
    }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Alumno</a>
        </div>

        <!-- navbar -->

        <nav class="text-white text-base font-semibold pt-3">
            <a href="#dashboard" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Ver calificaciones
            </a>
            <a href="#blank" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Administrar clases
            </a>

        </nav>

    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="#dashboard" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Ver calificaciones
                </a>
                <a href="#blank" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Administrar clase
                </a>

            </nav>
        </header>

        <!-- Parte derecha de la página -->
        <div class="w-full overflow-x-hidden border-t flex flex-col p-3">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>
                <p>¡Bienvenido al panel de control! Selecciona la acción que quieras realizar del menú de la izquierda.
                </p>
                <br>

                <!-- Contenido de las secciones (dashboard, blank, tables, forms)  -->
                <?php
                    // Configuración de la conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "proyecto_final";

                    // Crear una conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Error de conexión a la base de datos: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener datos de usuarios
                    $sql = "SELECT usuario_id, usuario_nombre, calificacion FROM usuarios";

                    $result = $conn->query($sql);

                    ?>

                    <!DOCTYPE html>
                    <html lang="es">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Tabla de Usuarios</title>
                        
                    </head>

                    <body>
                        <div id="dashboard" class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-2xl mb-4">Ver calificaciones</h2>
                            <div class="container mx-auto p-8">
                                <h1 class="text-3xl font-semibold mb-6">Tabla de Usuarios</h1>
                                <table class="min-w-full bg-white rounded-lg shadow overflow-hidden border border-gray-300">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th class="w-1/6 py-2 px-4 border">Usuario ID</th>
                                            <th class="w-2/6 py-2 px-4 border">Usuario Nombre</th>
                                            <th class="w-1/6 py-2 px-4 border">Calificación</th>
                                            <th class="w-1/6 py-2 px-4 border">Mensajes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Iterar a través de los resultados de la consulta
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td class='py-2 px-4 border'>" . $row["usuario_id"] . "</td>";
                                                echo "<td class='py-2 px-4 border'>" . $row["usuario_nombre"] . "</td>";
                                                echo "<td class='py-2 px-4 border'>" . $row["calificacion"] . "</td>";
                                                echo "<td class='py-2 px-4 border'></td>"; 
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </body>

                </html>

                <?php
// Cerrar la conexión a la base de datos
                $conn->close();
            ?>



                <br>

                <div id="blank" class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-2xl mb-4">Administrar clase</h2>


                    <form action="editar_registro.php" method="POST">
                        <!-- Campo de Correo Electrónico -->
                        <div class="mb-4">
                            <label for="correo" class="block text-gray-700 font-medium">Correo
                                Electrónico</label>
                            <input type="email" id="correo" name="correo"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>

                        <!-- Campo de Contraseña -->
                        <div class="mb-4">
                            <label for="contrasena" class="block text-gray-700 font-medium">Contraseña</label>
                            <input type="password" id="contrasena" name="contrasena"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>

                        <!-- Campo de Nombre -->
                        <div class="mb-4">
                            <label for="usuario_nombre" class="block text-gray-700 font-medium">Nombre</label>
                            <input type="text" id="usuario_nombre" name="usuario_nombre"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>

                        <!-- Campo de Apellido -->
                        <div class="mb-4">
                            <label for="apellido" class="block text-gray-700 font-medium">Apellido</label>
                            <input type="text" id="apellido" name="apellido"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>

                        <!-- Campo de Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="block text-gray-700 font-medium">Dirección</label>
                            <input type="text" id="direccion" name="direccion"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <br>

                        <!-- Campo de Fecha de Nacimiento -->
                        <div class="mb-4">
                            <label for="fecha_nacimiento" class="block text-gray-700 font-medium">Fecha de
                                Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <!-- Campo de Selección de Materias (Selección Múltiple) -->
                        <div class="mb-4">
                            <label for="materias" class="block text-gray-700 font-medium">Inscribir materias (Selecciona
                                múltiples manteniendo presionada la tecla Ctrl)</label>
                            <select id="materias" name="materias[]" multiple
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500">
                                <?php
                                    // Conecta a la base de datos y consulta las materias
                                    try {
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "proyecto_final";

                                        // Crear una conexión PDO
                                        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

                                        // Establecer el modo de error de PDO a excepción
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $sql = "SELECT id, nombre FROM materias";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();

                                        // Itera sobre las materias y crea las opciones del select
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $idMateria = $row['id'];
                                            $nombreMateria = $row['nombre'];
                                            echo "<option value=\"$idMateria\">$nombreMateria</option>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error en la conexión a la base de datos: " . $e->getMessage();
                                    }
                                    ?>
                            </select>
                        </div>

                        <br>
                        <!-- Botón de Enviar -->
                        <div class="mt-6">
                            <button type="submit" value="Guardar Cambios"
                                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Guardar
                                cambios</button>
                        </div>
                    </form>

                </div>


                <br>


                <!-- AlpineJS -->
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
                <!-- Font Awesome -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
                    integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
                <!-- ChartJS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
                    integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

                <script>
                // Agrega tus scripts de ChartJS aquí
                </script>
</body>

</html>