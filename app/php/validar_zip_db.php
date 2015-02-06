<?php
/* Descomentaríamos la siguiente línea para mostrar errores de php en el fichero: */
// ini_set('display_errors', '1');
/* Definimos los parámetros de conexión con la bbdd: */
$dbinfo = "mysql:dbname=albapardos_practica_validacion;host=localhost";
$user = "albapardos_root";
$pass = "rooter";

//Nos intentamos conectar:
try {
    /* conectamos con bbdd e inicializamos conexión como UTF8 */
    $db = new PDO($dbinfo, $user, $pass);
    $db->exec('SET CHARACTER SET utf8');
} catch (Exception $e) {
    echo "La conexi&oacute;n ha fallado: " . $e->getMessage();
}
/* Para hacer debug cargaríamos a mano el parámetro, descomentaríamos la siguiente línea: */
//$_REQUEST['email'] = "pepito@hotmail.com";
if (isset($_REQUEST['cp'])) {
    /* La línea siguiente la podemos descomentar para ver desde firebug-xhr si se pasa bien el parámetro desde el formulario */
    //echo $_REQUEST['email'];
    if (strlen($_REQUEST['cp']) >= 2){
        $cp = substr($_REQUEST['cp'], 0, 2);
    } else {
        $cp = $_REQUEST['cp'];
    }
    $sql = $db->prepare("SELECT Provincia FROM t_provincias WHERE CodProv=?");
    $sql->bindParam(1, $cp, PDO::PARAM_STR);
    $sql->execute();
    /* Ojo... PDOStatement::rowCount() devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE 
     * ejecutada por el correspondiente objeto PDOStatement.Si la última sentencia SQL ejecutada por el objeto PDOStatement 
     * asociado fue una sentencia SELECT, algunas bases de datos podrían devolver el número de filas devuelto por dicha sentencia. 
     * Sin embargo, este comportamiento no está garantizado para todas las bases de datos y no debería confiarse en él para 
     * aplicaciones portables.
     */
    $valid = 'true';
    if ($sql->rowCount() > 0) {
        $valid= 'false';
    } else {
       $valid='true';
    }
}
    $okey = $sql->fetch();    
    
    
}
$sql=null;
$db = null;
echo $okey[0];
?>