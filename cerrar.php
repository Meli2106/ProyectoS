<?php include ("template/cabecera.php");?> <!--menucabecera-->
<?php include ("conexion.php");?> <!--conexion a la base de datos-->

<?php 
session_start();
session_destroy();
header('Location:index.php');
?>

<?php include ("template/footer.php");?> <!--footer-->