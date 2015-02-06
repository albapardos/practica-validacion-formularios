<?php
// Datos de conexion para mi base de datos
$dbinfo = "mysql:dbname=practica_validacion;host=localhost";
$user = "root";
$pass = "root";

// Intentamos conectar
try {
    // Conectamos a la BBDD 
    $db = new PDO($dbinfo, $user, $pass);
    // Inicializamos la conexion como utf8 para que coja correctamente caracteres españoles como la ñ
    $db->exec('SET CHARACTER SET utf8');
} catch (Exception $e) {
    echo "La conexi&oacute;n ha fallado: " . $e->getMessage();
}

// Si hemos recibido una variable email
if (isset($_REQUEST['email'])) {
    // Guardamos en una variable el email
    $email = $_REQUEST['email'];
    //Preparamos y lanzamos la consulta
    $sql = $db->prepare("SELECT * FROM usuarios WHERE email=?");
    $sql->bindParam(1, $email, PDO::PARAM_STR); 
    $sql->execute();

    // Declaramos una variable para almacer si todo fue bien o no, y lo comprobamos asignado
    $valid;
    if ($sql->rowCount() > 0) {
        $valid= 'false';
    } else {
       $valid='true';
    }
}

// Devolvemos el resultado de la busqueda, finalmente si existe dara error
echo $valid;

// Liberamos recursos (BBDD y consulta)
$sql=null;
$db = null;
?>
