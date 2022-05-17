
<?php include ("conexion.php"); ?><!--conexion a la base de datos-->

<div style="text-align:center"><!--menu de crud-->
    <div class= "btn-group" role= "group" aria-label="">
        <button type= "submit" name= "accion" value= "Registrar_pedido" class= "btn btn-success" style= "Margin:8px">Registrar Pedido</button>
        <button type= "submit" name= "accion" value= "Modificar_pedido" class= "btn btn-warning" style= "Margin:8px">Modificar Pedido</button>
        <button type= "submit" name= "accion" value= "Borrar_pedido" class= "btn btn-info" style= "Margin:8px">Borrar Pedido</button>
        <input type= "text" name= "Cedula_cliente" id= "Cedula_cliente" style= "Margin:8px"/>
        <button type= "text" name= "accion" value= "Buscar_pedido" class= "btn btn-info" style= "Margin:8px">Buscar Pedido</button>
    </div> 
</div>
<?php

$Nombres_cliente =(isset($_POST['Nombres_cliente']))? $_POST['Nombres_cliente']:"";
$Apellidos_cliente =(isset($_POST['Apellidos_cliente']))? $_POST['Apellidos_cliente']:"";
$Tdocumento_cliente =(isset($_POST['Tdocumento_cliente']))? $_POST['Tdocumento_cliente']:"";
$Cedula_cliente =(isset($_POST['Cedula_cliente']))? $_POST['Cedula_cliente']:"";
$Direccion_cliente =(isset($_POST['Direccion_cliente']))? $_POST['Direccion_cliente']:"";
$Contacto_cliente =(isset($_POST['Contacto_cliente']))? $_POST['Contacto_cliente']:"";
$Fecha_Registro_pedido =(isset($_POST['Fecha_Registro_pedido']))? $_POST['Fecha_Registro_pedido']:"";
$Prioridad_Pedido =(isset($_POST['Prioridad_Pedido']))? $_POST['Prioridad_Pedido']:"";
$Estado_Pedido=(isset($_POST['Estado_Pedido']))? $_POST['Estado_Pedido']:"";
$Nombre_Producto=(isset($_POST['Nombre_Producto']))? $_POST['Nombre_Producto']:"";
$Fecha_Entrega_Pedido=(isset($_POST['Fecha_Entrega_Pedido']))? $_POST['Fecha_Entrega_Pedido']:"";


$accion =(isset($_POST['accion']))? $_POST['accion']:"";

switch ($accion) {
    /*SQL en la base de datos,registro de datos*/
    case "Registrar":
    $sql =$conexion->prepare("INSERT INTO cliente(Nombres_cliente,Apellidos_cliente,Tdocumento_cliente,Cedula_cliente,Direccion_cliente,Contacto_cliente) VALUES (:Nombres_cliente,:Apellidos_cliente,:Tdocumento_cliente,:Cedula_cliente,:Direccion_cliente,:Contacto_cliente);");

    $sql ->bindParam(':Nombres_cliente',$Nombres_cliente);
    $sql ->bindParam(':Apellidos_cliente',$Apellidos_cliente);
    $sql ->bindParam(':Tdocumento_cliente',$Tdocumento_cliente);
    $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
    $sql ->bindParam(':Direccion_cliente',$Direccion_cliente);
    $sql ->bindParam(':Contacto_cliente',$Contacto_cliente);
    $sql ->execute();
    break;

    /*SQL en la base de datos,modificar de datos*/
    case "Modificar":
        $sql= $conexion->prepare("UPDATE cliente SET Nombres_cliente=:Nombres_cliente,Apellidos_cliente=:Apellidos_cliente,Tdocumento_cliente=:Tdocumento_cliente,Cedula_cliente=:Cedula_cliente,Direccion_cliente=:Direccion_cliente,Contacto_cliente=:Contacto_cliente WHERE Cedula_cliente=:Cedula_cliente");
        $sql ->bindParam(':Nombres_cliente',$Nombres_cliente);
        $sql ->bindParam(':Apellidos_cliente',$Apellidos_cliente);
        $sql ->bindParam(':Tdocumento_cliente',$Tdocumento_cliente);
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->bindParam(':Direccion_cliente',$Direccion_cliente);
        $sql ->bindParam(':Contacto_cliente',$Contacto_cliente);
        $sql ->execute();
    break;
        
    /*SQL en la base de datos,borrar de datos*/
    case "Borrar":
        $sql =$conexion->prepare("DELETE FROM cliente WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();
    break;

    /*SQL en la base de datos,buscar de datos*/
    case "Buscar":
        $sql= $conexion->prepare("SELECT * FROM cliente WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();
        $Buscar_clientes =$sql->fetch(PDO::FETCH_LAZY);

        $Nombres_cliente =$Buscar_clientes['Nombres_cliente'];
        $Apellidos_cliente =$Buscar_clientes['Apellidos_cliente'];
        $Tdocumento_cliente =$Buscar_clientes['Tdocumento_cliente'];
        $Cedula_cliente =$Buscar_clientes['Cedula_cliente'];
        $Direccion_cliente =$Buscar_clientes['Direccion_cliente'];
        $Contacto_cliente =$Buscar_clientes['Contacto_cliente'];
        $Fecha_Registro_pedido =$Buscar_clientes['Fecha_Registro_pedido'];
        $Prioridad_Pedido =$Buscar_clientes['Prioridad_Pedido'];
        $Estado_Pedido=$Buscar_clientes['Estado_Pedido'];
        $id_Detalle_Pedido=$Buscar_clientes['id_Detalle_Pedido'];
        $Fecha_Entrega_Pedido=$Buscar_clientes['Fecha_Entrega_Pedido'];
    break;
}

/*consulta de todo los datos en la base de datos*/
    $sql =$conexion->prepare("SELECT A.id_Pedido,A.Fecha_Entrega_Pedido ,A.Estado_Pedido, A.Prioridad_Pedido,A.Fecha_Registro_pedido, C.Cedula_cliente,C.Tdocumento_cliente, C.Nombres_cliente, C.Apellidos_cliente,C.Direccion_cliente,C.Contacto_cliente,D.Nombre_Producto FROM pedidos A INNER JOIN detalle_pedido B ON A.id_Pedido =B.id_Detalle_Pedido INNER JOIN cliente C ON A.id_Cliente_P = C.id_Cliente INNER JOIN producto D ON B.id_Producto_D = D.id_Producto");
    $sql ->execute();
    $lista_pedidos=$sql->fetchAll(PDO::FETCH_ASSOC); 

?>

<div class= "col-md-12">
        <div class= "card">
        <div class= "card-header">
    <table class= "table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>TIPO DE DOCUMENTO</th>
                <th>NUMERO DE DOCUMENTO</th>
                <th>DIRECCION</th>
                <th>CONTACTO</th>
                <th>FECHA REGISTRO PEDIDO</th>
                <th>PRIORIDAD DEL PEDIDO</th>
                <th>ESTADO DEL PEDIDO</th>
                <th>DETALLE DEL PEDIDO</th>
                <th>FECHA DE ENTREGA DEL PEDIDO</th>
                </tr>
        </thead>
        <!--resultado de los datos registrados en la base de datos -->
        <tbody>
        <?php foreach($lista_pedidos as $pedido){ ?>
            <tr>
                <th><?php echo $pedido['id_Pedido'];?></th>
                <th><?php echo $pedido['Nombres_cliente'];?></th>
                <th><?php echo $pedido['Apellidos_cliente'];?></th>
                <th><?php echo $pedido['Tdocumento_cliente'];?></th>
                <th><?php echo $pedido['Cedula_cliente'];?></th>
                <th><?php echo $pedido['Direccion_cliente'];?></th>
                <th><?php echo $pedido['Contacto_cliente'];?></th>
                <th><?php echo $pedido['Fecha_Registro_pedido'];?></th>
                <th><?php echo $pedido['Prioridad_Pedido'];?></th>
                <th><?php echo $pedido['Estado_Pedido'];?></th>
                <th><?php echo $pedido['Nombre_Producto'];?></th>
                <th><?php echo $pedido['Fecha_Entrega_Pedido'];?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include ("template/footer.php");?><!--footer-->
