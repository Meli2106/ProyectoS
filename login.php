<?php include ("conexion.php");?> <!--conexion a la base de datos-->
<?php
/*validacion de login*/
session_start();
$Usuario=$_POST['Usuario'];
$Clave=$_POST['Clave'];

  $sql= $conexion->prepare("SELECT * FROM usuario WHERE Usuario=:Usuario && Clave=:Clave");
  $sql ->bindParam(':Usuario',$Usuario);
  $sql ->bindParam(':Clave',$Clave);
  $sql ->execute();
  $Buscar_Usuario=$sql->fetch(PDO::FETCH_LAZY);

  $Usuario =$Buscar_Usuario['Usuario'];
  $Clave=$Buscar_Usuario['Clave'];

  if($Usuario==$Buscar_Usuario && $Clave==$Buscar_Usuario){
  
  header('Location:pedidos.php');

  }else{
    $mensaje=" Datos incorrectos, valide nuevamente la informacion ";


  }
  ?>
