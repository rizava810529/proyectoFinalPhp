<?php
// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto_final";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se ha enviado el formulario con una materia seleccionada
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $materiaSeleccionada = $_POST["materias"];
    } else {
        // Si no se ha seleccionado una materia, establece un valor predeterminado (puedes cambiarlo según tus necesidades)
        $materiaSeleccionada = "Materia1";
    }
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

                <!-- Contenido de las secciones (dashboard, blank, tables, forms) aquí... -->
                <?php
try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;dbname=proyecto_final", "root", "");

    // Consulta para obtener la lista de materias desde la tabla "materias"
    $sqlMaterias = "SELECT nombre FROM materias";
    $stmtMaterias = $pdo->prepare($sqlMaterias);
    $stmtMaterias->execute();
    $materias = $stmtMaterias->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
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

    // Consulta para obtener la lista de materias desde la tabla "materias"
    $sqlMaterias = "SELECT nombre FROM materias";
    $stmtMaterias = $pdo->prepare($sqlMaterias);
    $stmtMaterias->execute();
    $materias = $stmtMaterias->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
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

    // Consulta para obtener la lista de materias desde la tabla "materias"
    $sqlMaterias = "SELECT nombre FROM materias";
    $stmtMaterias = $pdo->prepare($sqlMaterias);
    $stmtMaterias->execute();
    $materias = $stmtMaterias->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>

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

    // Consulta para obtener la lista de materias desde la tabla "materias"
    $sqlMaterias = "SELECT nombre FROM materias";
    $stmtMaterias = $pdo->prepare($sqlMaterias);
    $stmtMaterias->execute();
    $materias = $stmtMaterias->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
<!-- yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy -->



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

    // Consulta para obtener la lista de materias desde la tabla "materias"
    $sqlMaterias = "SELECT nombre FROM materias";
    $stmtMaterias = $pdo->prepare($sqlMaterias);
    $stmtMaterias->execute();
    $materias = $stmtMaterias->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

// Mostrar los datos recibidos por POST para verificar
var_dump($_POST);
?>

<div id="dashboard" class="bg-white p-6 border rounded-lg shadow">
    <div>
        <div class="flex justify-between space-x-4">
            <div>
                <div class="flex justify-between space-x-4">
                    <h2 class="text-2xl mb-4">Mensajes de la clase</h2>
                    <div class="flex justify-between space-x-4 text-2xl mb-4">
                        <form method="post">
                            <div class="w-64">
                                <label for="materias" class="block text-gray-700 font-bold">Selecciona una
                                    materia:</label>
                                <select id="materias" name="materias"
                                    class="block w-full mt-2 px-4 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:border-blue-500"
                                    onchange="this.form.submit()">
                                    <?php
                                    // Generar opciones
                                    foreach ($materias as $materia) {
                                        $selected = ($_POST['materias'] == $materia) ? 'selected' : '';
                                        echo "<option value='$materia' $selected>$materia</option>";
                                    }
                                    echo "<pre>";
                                    var_dump($_POST['materias']);
                                    echo "</pre>";
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenedor de la tabla de mensajes -->
<div id="mensajes-table" class="container mx-auto p-8">
    <h1 class="text-3xl font-semibold mb-6">Tabla de Mensajes</h1>
    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden border border-gray-300">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/6 py-2 px-4 border">Mensaje ID</th>
                <th class="w-2/6 py-2 px-4 border">Contenido</th>
                <th class="w-1/6 py-2 px-4 border">Fecha de Envío</th>
                <!-- Puedes agregar más columnas aquí según la estructura de tu tabla mensajes -->
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['materias'])) {
                $selectedMateria = $_POST['materias'];
                try {
                    // Realiza una consulta SQL para obtener los mensajes de los usuarios
                    $sqlMensajes = "SELECT mensaje_id, contenido, fecha_envio FROM mensajes JOIN usuarios ON mensajes.usuario_id = usuarios.usuario_id WHERE usuarios.materia_id = :materia";
                    $stmtMensajes = $pdo->prepare($sqlMensajes);
                    $stmtMensajes->bindParam(':materia', $selectedMateria);
                    $stmtMensajes->execute();
                    $mensajes = $stmtMensajes->fetchAll(PDO::FETCH_ASSOC);

                    echo "<pre>";
                    var_dump($_POST);
                    var_dump($mensajes);
                    echo "</pre>";

                    // Generar filas de la tabla de mensajes
                    foreach ($mensajes as $mensaje) {
                        echo "<tr>";
                        echo "<td>" . $mensaje['mensaje_id'] . "</td>";
                        echo "<td>" . $mensaje['contenido'] . "</td>";
                        echo "<td>" . $mensaje['fecha_envio'] . "</td>";
                        // Puedes agregar más columnas aquí según la estructura de tu tabla mensajes
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Error en la consulta: " . $e->getMessage();
                }
            }
            ?>
        </tbody>
    </table>
</div>


            <!-- Contenedor





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