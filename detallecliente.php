<?php include ("conexion.php");?><!--conexion a la base de datos-->
 
<?php /*almacenamiento de datos*/
$Nombres_cliente =(isset($_POST['Nombres_cliente']))? $_POST['Nombres_cliente']:"";
$Apellidos_cliente =(isset($_POST['Apellidos_cliente']))? $_POST['Apellidos_cliente']:"";
$Tdocumento_cliente =(isset($_POST['Tdocumento_cliente']))? $_POST['Tdocumento_cliente']:"";
$Cedula_cliente =(isset($_POST['Cedula_cliente']))? $_POST['Cedula_cliente']:"";
$Direccion_cliente =(isset($_POST['Direccion_cliente']))? $_POST['Direccion_cliente']:"";
$Contacto_cliente =(isset($_POST['Contacto_cliente']))? $_POST['Contacto_cliente']:"";

$accion =(isset($_POST['accion']))? $_POST['accion']:"";


?>
<!--botones y formulario de crud-->

<div class= "btn-group" role= "group" aria-label="" style="text-align:center" >
       
        <button type= "button" href= "index.php" name= "accion" value= "Registrar" class= "btn btn-success" style= "Margin:8px" >Registrar</button>
        <button type= "submit" name= "accion" value= "Modificar" <?php echo $accionModificarcliente;?> class= "btn btn-warning" style= "Margin:8px">Modificar Cliente</button>
        <button type= "submit" name= "accion" value= "Borrar" <?php echo $accionBorrarcliente;?> class= "btn btn-info" style= "Margin:8px">Borrar Cliente</button>
        <button type= "submit" name= "accion" value= "Cancelar" <?php echo $accionCancelarcliente;?> class= "btn btn-info" style= "Margin:8px">Cancelar</button>
        <input type= "text" name= "Cedula_cliente" id= "Cedula_cliente" style= "Margin:8px"/>
        <button type= "text" name= "accion" value= "Buscar" class= "btn btn-info" value="<?php echo $cliente['Cedula_cliente'];?>" style= "Margin:8px">Buscar Cliente</button>
        
</div> <br>
<?php
switch ($accion){
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
    case "Modificar cliente":
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
    case "Borrar cliente ":
        $sql =$conexion->prepare("DELETE FROM cliente WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();
    break;

    /*SQL en la base de datos,buscar de datos*/
    case "Buscar cliente":
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
    break;

    case "Seleccionar":

    $accionRegistrarcliente="disabled";
    $accionModificarcliente=$accionBorrarcliente=$accionCancelarcliente="";
    break;
    case "Cancelar":
        header('detallecliente.php');
    break;

}?>

<?php
/*consulta de todo los datos en la base de datos-- Tabla principal*/
    $sql =$conexion->prepare("SELECT * FROM cliente");
    $sql ->execute();
    $lista_clientes =$sql->fetchAll(PDO::FETCH_ASSOC); 
?>
<div class= "col-md-12"><br>
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
                <th>ACCIONES</th>
            </tr>
        </thead>
        <!--resultado de los datos registrados en la base de datos -->
        <tbody>
        <?php foreach($lista_clientes as $cliente){ ?>
            <tr>
                <th><?php echo $cliente['id_Cliente'];?></th>
                <th><?php echo $cliente['Nombres_cliente'];?></th>
                <th><?php echo $cliente['Apellidos_cliente'];?></th>
                <th><?php echo $cliente['Tdocumento_cliente'];?></th>
                <th><?php echo $cliente['Cedula_cliente'];?></th>
                <th><?php echo $cliente['Direccion_cliente'];?></th>
                <th><?php echo $cliente['Contacto_cliente'];?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
        </div>


