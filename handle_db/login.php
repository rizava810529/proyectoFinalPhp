<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    session_start();    
    extract($_POST);

    require_once($_SERVER["DOCUMENT_ROOT"]. "/config/database.php");


$query = "SELECT * FROM users WHERE email = ? AND password = ?";
try { 
  $stmnt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");

  $stmnt->bindParam(":correo", $correo, PDO::PARAM_STR);
  $stmnt->execute();
  
    if ($stmnt->rowCount() === 1){
        //echo "el correo existe";
        //despues de corroborar el hash de la contraseña
       /*  switch ($row = $stmnt->fetch(PDO::FETCH_ASSOC)){
            case $row["role_id"] === 1:
              $_SESSION ["role"] =1;//se puede usar en todo el programa para hacer corroborciones
              header("location: /views/admin/dashboard.php");
              break ;
            case $row["role_id"] === 2:
                $_SESSION ["role"] =2;
                header("location: /views/maestro/dashboard.php");
              break ;
            case $row["role_id"] === 3:
                $_SESSION ["role"] =3;
                header("location: /views/alumno/dashboard.php");
              break ;

            default:
            echo "no tienes ningun, lo siento no puedes ingresar";
            break;
            }
        }else{
        echo "el correo no existe"; */


        //despues de corroborar el hash de la contraseña
        
        $_SESSION["user_data"] = $stmnt->fetch(PDO::FETCH_ASSOC);

        header("location: src/views/dashboard.php");

    }else{
        echo "el correo no existe";}

}catch (PDOExepcion $e){
    echo "Error: " . $e->getMessage();
}

}