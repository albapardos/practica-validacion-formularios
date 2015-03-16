<!DOCTYPE html>
<html>
<head>
    <title>Enviar</title>
</head>
<body>


<?php
$mensualidad=$_POST['pago'];
echo "Se va a proceder al cobro de la primera factura con un total de $mensualidad euros";
echo "<br><a href='../index.html' >Aceptar</a>  <a href='../index.html'>Cancelar</a>";
?>

</body>
</html>