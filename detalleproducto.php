<?php include ("conexion.php"); ?><!--conexion a la base de datos-->
<?php include ("template/cabecera.php");?> <!--menucabecera-->

<?php
$Nombre_Producto =(isset($_POST['Nombre_Producto']))? $_POST['Nombre_Producto']:"";
$Detalle_Producto =(isset($_POST['Detalle_Producto']))? $_POST['Detalle_Producto']:"";
$Categoria_Producto =(isset($_POST['Categoria_Producto']))? $_POST['Categoria_Producto']:"";
$Precio_Producto =(isset($_POST['Precio_Producto']))? $_POST['Precio_Producto']:"";

$accion =(isset($_POST['accion']))? $_POST['accion']:"";

switch ($accion) {
    /*SQL en la base de datos,registro de datos*/
    case "Registrar":
    $sql =$conexion->prepare("INSERT INTO producto(Nombre_Producto,Detalle_Producto,Categoria_Producto,Precio_Producto) VALUES (:Nombre_Producto,:Detalle_Producto ,:Categoria_Producto,:Precio_Producto);");

    $sql ->bindParam(':Nombre_Producto',$Nombre_Producto);
    $sql ->bindParam(':Detalle_Producto',$Detalle_Producto );
    $sql ->bindParam(':Categoria_Producto',$Categoria_Producto);
    $sql ->bindParam(':Precio_Producto',$Precio_Producto);
    $sql ->execute();
    break;

    /*SQL en la base de datos,modificar de datos*/
    case "Modificar":
        $sql= $conexion->prepare("UPDATE producto SET Nombre_Producto=:Nombre_Producto,Detalle_Producto=:Detalle_Producto,Categoria_Producto=:Categoria_Producto,Precio_Producto=:Precio_Producto WHERE Categoria_Producto=:Categoria_Producto");
        $sql ->bindParam(':Nombre_Producto',$Nombre_Producto);
        $sql ->bindParam(':Detalle_Producto',$Detalle_Producto);
        $sql ->bindParam(':Categoria_Producto',$Categoria_Producto);
        $sql ->bindParam(':Precio_Producto',$Precio_Producto);
        $sql ->execute();
    break;
        
    /*SQL en la base de datos,borrar de datos*/
    case "Borrar":
        $sql =$conexion->prepare("DELETE FROM producto WHERE Categoria_Producto=:Categoria_Producto");
        $sql ->bindParam(':Categoria_Producto',$Categoria_Producto);
        $sql ->execute();
    break;

    /*SQL en la base de datos,buscar de datos*/
    case "Buscar":
        $sql= $conexion->prepare("SELECT * FROM producto WHERE Categoria_Producto =:Categoria_Producto");
        $sql ->bindParam(':Categoria_Producto',$Categoria_Producto);
        $sql ->execute();
        $Buscar_productos =$sql->fetch(PDO::FETCH_LAZY);

        $Nombre_Producto =$Buscar_productos['Nombre_Producto'];
        $Detalle_Producto=$Buscar_productos['Detalle_Producto'];
        $Categoria_Producto =$Buscar_productos['Categoria_Producto'];
        $Precio_Producto=$Buscar_productos['Precio_Producto'];
    break;
}
/*consulta de todo los datos en la base de datos*/
    $sql =$conexion->prepare("SELECT *FROM producto");
    $sql ->execute();
    $lista_productos =$sql->fetchAll(PDO::FETCH_ASSOC); 

?>

<div class= "col-md-12">
        <div class= "card">
        <div class= "card-header">
    <table class= "table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE PRODUCTO</th>
                <th>DETALLE PRODUCTO</th>
                <th>CATEGORIA PRODUCTO</th>
                <th>PRECIO PRODUCTO</th>
            </tr>
        </thead>
        <!--resultado de los datos registrados en la base de datos -->
        <tbody>
        <?php foreach($lista_productos as $producto){ ?>
            <tr>
                <th><?php echo $producto['id_Producto'];?></th>
                <th><?php echo $producto['Nombre_Producto'];?></th>
                <th><?php echo $producto['Detalle_Producto'];?></th>
                <th><?php echo $producto['Categoria_Producto'];?></th>
                <th><?php echo $producto['Precio_Producto'];?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>