

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="description" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Tailwind CSS -->
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
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Maestro</a>
        </div>

        <!-- navbar -->
        <nav class="text-white text-base font-semibold pt-3">
            <a href="#dashboard"
                class="flex items-center <?php if ($materiaSeleccionada == 'Materia1') echo 'active-nav-link'; ?> text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Alumnos
            </a>
            <a href="#blank"
                class="flex items-cdhanger alt yalargenesente natural ?-100 text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Datos de perfil
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            contenido header
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html"
                    class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="#dashboard"
                    class="flex items-center <?php if ($materiaSeleccionada == 'Materia1') echo 'active-nav-link'; ?> text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Alumnos
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
<!-- yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy -->
        

<div id="dashboard" class="bg-white p-6 border rounded-lg shadow"> 
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
    
    // Consulta SQL para obtener los alumnos que tienen clase con el maestro
    $maestro_id = 3; // Reemplaza con el ID del maestro que deseas consultar
$sql = "SELECT usuario_id, usuario_nombre, calificacion
       FROM usuarios
       WHERE maestro_id = :maestro_id AND rol = 'alumnos'";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':maestro_id', $maestro_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alumnos del Maestro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Alumnos del Maestro</h1>

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre del Alumno</th>
                <th class="px-4 py-2">Calificación</th>
                <th class="px-4 py-2">Mensaje</th>
                <th class="px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($alumnos as $alumno) {
                echo "<tr>";
                echo "<td class='border px-4 py-2'>" . $alumno["usuario_id"] . "</td>";
                echo "<td class='border px-4 py-2'>" . $alumno["usuario_nombre"] . "</td>";
                echo "<td class='border px-4 py-2'>" . $alumno["calificacion"] . "</td>";
                
                // Verificar si la clave 'contenido' existe en el array
                if (array_key_exists("contenido", $alumno)) {
                    echo "<td class='border px-4 py-2'>" . $alumno["contenido"] . "</td>";
                } else {
                    echo "<td class='border px-4 py-2'>Sin contenido</td>";
                }
                
                echo "<td class='border px-4 py-2'><button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Enviar Mensaje</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>







<!-- yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy -->


                <br>

                <div id="blank" class="bg-white p-6 rounded-lg shadow">
                
       <div>
           <div class="flex justify-between space-x-4">
               <h2 class="text-2xl mb-4">Editar datos del perfil</h2>
               <div class="bg-white p-8 rounded shadow-md w-96">
                   <h1 class="text-2xl font-semibold mb-4">Registro de Usuario</h1>
                   <form action="procesar_registro.php" method="POST">
                       <!-- Campo de Correo Electrónico -->
                       <div class="mb-4">
                           <label for="correo" class="block text-gray-700 font-medium">Correo Electrónico</label>
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
                           <label for="nombre" class="block text-gray-700 font-medium">Nombre</label>
                           <input type="text" id="nombre" name="nombre"
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

                       <!-- Campo de Fecha de Nacimiento -->
                       <div class="mb-4">
                           <label for="fecha_nacimiento" class="block text-gray-700 font-medium">Fecha de Nacimiento</label>
                           <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500"
                               required>
                       </div>

                       <!-- Campo de Selección de Materias (Selección Múltiple) -->
                       <div class="mb-4">
                           <label for="materias" class="block text-gray-700 font-medium">Materias que dicta (Selecciona múltiples manteniendo presionada la tecla Ctrl)</label>
                           <select id="materias" name="materias[]" multiple
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:border-blue-500">
                               <?php
                               // Conectar a la base de datos y consulta las materias
                               $servername = "localhost";
                               $username = "root";
                               $password = "";
                               $dbname = "proyecto_final";

                               $conn = new mysqli($servername, $username, $password, $dbname);

                               if ($conn->connect_error) {
                                   die("Error en la conexión a la base de datos: " . $conn->connect_error);
                               }

                               $sql = "SELECT id, nombre FROM materias";
                               $result = $conn->query($sql);

                               if ($result->num_rows > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                       $idMateria = $row['id'];
                                       $nombreMateria = $row['nombre'];
                                       echo "<option value=\"$idMateria\">$nombreMateria</option>";
                                   }
                               }

                               $conn->close();
                               ?>
                           </select>
                       </div>

                       <div class="mt-6">
                           <button type="submit" class="w-full bg-blue-500 text-black py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Guardar cambios</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
                <br>
                <!-- AlpineJS -->
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer>
                </script>
                <!-- Font Awesome -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
                    integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous">
                </script>
                <!-- ChartJS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
                    integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous">
                </script>

                

            </main>
        </div>
    </div>
</body>

</html>