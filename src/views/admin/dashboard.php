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
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        </div>

        <!-- navbar -->

        <nav class="text-white text-base font-semibold pt-3">
            <a href="#dashboard" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Permisos
            </a>
            <a href="#blank" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Maestros
            </a>
            <a href="#alumnos" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Alumnos
            </a>
            <a href="#clases" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Clases
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
                    Permisos
                </a>
                <a href="#blank" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Maestros
                </a>
                <a href="#alumnos" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Alumnos
                </a>
                <a href="#clases" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Clases
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

                <!-- Contenido de las secciones (dashboard, blank, tables, forms) aquí... -->
                <div id="dashboard" class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl mb-4">Permisos</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Usuario ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Permiso (Rol)</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $fila) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . $fila["usuario_id"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $fila["usuario_nombre"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $fila["correo"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $fila["rol"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $fila["estado"] . "</td>";
                    echo "<td class='border px-4 py-2'>
                        <form method='post' action='src/controllers/actualizar_estado.php' class='flex items-center'>
                            <input type='hidden' name='usuario_id' value='" . $fila["usuario_id"] . "'>
                            <select name='nuevo_estado' class='mr-2 border rounded p-1'>
                                <option value='activo'>Activo</option>
                                <option value='inactivo'>Inactivo</option>
                            </select>
                            <button type='submit' class='bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700'>Aplicar</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

                <br>
                <!-- ... (otros encabezados HTML) ... -->

                <div id="blank" class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl mb-4">Maestros</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Fecha de nacimiento</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Direccion</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Editar/Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $fila) {
                    // Verifica si el rol es "maestro" antes de imprimir el registro
                    if ($fila["rol"] === "maestro") {
                        echo "<tr>";
                        echo "<td class='border px-4 py-2'>" . $fila["usuario_id"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["usuario_nombre"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["fecha_nacimiento"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["correo"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["direccion"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["rol"] . "</td>";
                        echo "<td class='border px-4 py-2'><a href='editar.php?id=" . $fila["usuario_id"] . "' class='text-blue-500 hover:underline'>Editar</a> / <a href='borrar.php?id=" . $fila["usuario_id"] . "' class='text-red-500 hover:underline'>Borrar</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


                <br>

                <div id="blank" class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl mb-4">Alumnos</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Fecha de nacimiento</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Dirección</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Editar/Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $fila) {
                    // Verifica si el rol es "alumno" antes de imprimir el registro
                    if ($fila["rol"] === "alumno") {
                        echo "<tr>";
                        echo "<td class='border px-4 py-2'>" . $fila["usuario_id"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["usuario_nombre"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["fecha_nacimiento"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["correo"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["direccion"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $fila["rol"] . "</td>";
                        echo "<td class='border px-4 py-2'>
                            <a href='editar.php?id=" . $fila["usuario_id"] . "' class='text-blue-500 hover:underline'>Editar</a> /
                            <a href='borrar.php?id=" . $fila["usuario_id"] . "' class='text-red-500 hover:underline'>Borrar</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


                <br>
                <div id="clases" class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-2xl mb-4">Clases</h2>
                    <form>
                        <!-- Aquí puedes agregar tus campos de formulario -->
                        <p>Esta es una página en blanco. Puedes agregar contenido personalizado aquí.</p>
                    </form>
                </div>
            </main>

            <footer class="w-full bg-white text-right p-4">
                <p>Footer</p>
            </footer>
        </div>
    </div>

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
