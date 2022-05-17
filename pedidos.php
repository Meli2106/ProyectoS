<?php include("template/cabecera.php");?> <!--menucabecera-->
<?php include ("conexion.php");?> <!--conexion a la base de datos-->


<?php /*almacenamiento de datos*/
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

    $accionRegistrar="";
    $accionModificar=$accionEliminar=$accionCancelar="disabled";
    $mostrarvista2=false;


switch ($accion) {
    /*SQL en la base de datos,registro de datos*/
    case "Registrar":
    $sql =$conexion->prepare("INSERT INTO pedidos(Nombres_cliente,Apellidos_cliente,Tdocumento_cliente,Cedula_cliente,Direccion_cliente,Contacto_cliente,Fecha_Registro_pedido,Estado_Pedido,Nombre_Producto,Fecha_Entrega_Pedido) VALUES (:Nombres_cliente,:Apellidos_cliente,:Tdocumento_cliente,:Cedula_cliente,:Direccion_cliente,:Contacto_cliente,:Fecha_Registro_pedido,:Estado_Pedido,:Nombre_Producto,:Fecha_Entrega_Pedido);");

    $sql ->bindParam(':Nombres_cliente',$Nombres_cliente);
    $sql ->bindParam(':Apellidos_cliente',$Apellidos_cliente);
    $sql ->bindParam(':Tdocumento_cliente',$Tdocumento_cliente);
    $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
    $sql ->bindParam(':Direccion_cliente',$Direccion_cliente);
    $sql ->bindParam(':Contacto_cliente',$Contacto_cliente);
    $sql ->bindParam(':Fecha_Registro_pedido',$Fecha_Registro_pedido);
    $sql ->bindParam(':Estado_Pedido',$Estado_Pedido);
    $sql ->bindParam(':Nombre_Producto',$Nombre_Producto);
    $sql ->bindParam(':Fecha_Entrega_Pedido',$Fecha_Entrega_Pedido);
    $sql ->execute();
    header("Location:pedidos.php");
    break;

    /*SQL en la base de datos,modificar de datos*/
    case "Modificar":
        $sql= $conexion->prepare("UPDATE pedidos SET Nombres_cliente=:Nombres_cliente,Apellidos_cliente=:Apellidos_cliente,Tdocumento_cliente=:Tdocumento_cliente,Cedula_cliente=:Cedula_cliente,Direccion_cliente=:Direccion_cliente,Contacto_cliente=:Contacto_cliente,Fecha_Registro_pedido=:Fecha_Registro_pedido,Estado_Pedido=:Estado_Pedido,Nombre_Producto=:Nombre_Producto,Fecha_Entrega_Pedido=:Fecha_Entrega_Pedido WHERE Cedula_cliente=:Cedula_cliente");
        $sql ->bindParam(':Nombres_cliente',$Nombres_cliente);
        $sql ->bindParam(':Apellidos_cliente',$Apellidos_cliente);
        $sql ->bindParam(':Tdocumento_cliente',$Tdocumento_cliente);
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->bindParam(':Direccion_cliente',$Direccion_cliente);
        $sql ->bindParam(':Contacto_cliente',$Contacto_cliente);
        $sql ->bindParam(':Fecha_Registro_pedido',$Fecha_Registro_pedido);
        $sql ->bindParam(':Estado_Pedido',$Estado_Pedido);
        $sql ->bindParam(':Nombre_Producto',$Nombre_Producto);
        $sql ->bindParam(':Fecha_Entrega_Pedido',$Fecha_Entrega_Pedido);
        $sql ->execute();
        header("Location:pedidos.php");
    
    break;
        
    /*SQL en la base de datos,borrar de datos*/
    case "Eliminar":
        $sql =$conexion->prepare("DELETE FROM pedidos WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();header("Location:pedidos.php");
        
    break;

    /*SQL en la base de datos,buscar de datos*/
    case "Buscar":
        $sql= $conexion->prepare("SELECT * FROM pedidos WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();
        $Buscar_pedidos =$sql->fetch(PDO::FETCH_LAZY);

        $Nombres_cliente =$Buscar_pedidos['Nombres_cliente'];
        $Apellidos_cliente =$Buscar_pedidos['Apellidos_cliente'];
        $Tdocumento_cliente =$Buscar_pedidos['Tdocumento_cliente'];
        $Cedula_cliente =$Buscar_pedidos['Cedula_cliente'];
        $Direccion_cliente =$Buscar_pedidos['Direccion_cliente'];
        $Contacto_cliente =$Buscar_pedidos['Contacto_cliente'];
        $Fecha_Registro_pedido =$Buscar_pedidos['Fecha_Registro_pedido'];
        $Estado_Pedido =$Buscar_pedidos['Estado_Pedido'];
        $Nombre_Producto =$Buscar_pedidos['Nombre_Producto'];
        $Fecha_Entrega_Pedido =$Buscar_clientes['Fecha_Entrega_Pedido'];

    break;

    case "Seleccionar":
        $accionRegistrar= "disabled";
        $accionModificar=$accionEliminar=$accionCancelar= "";
        $mostrarvista2=true;

    break;

    case "Cancelar":

        header("Location:pedidos.php");

    break;

}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas Rivillas</title>
</head>
<body>
<!--formulario de registro-->   
        <form method= "post" enctype= "multipart/form-data">
        <input type= "text" style= "Margin:8px"/>
        <input type= "submit" name= "accion" value= "Buscar" class= "btn btn-primary" style= "Margin:8px" />

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Pedido Cliente Nuevo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="form-row" >
        
        <div class= "form-group">
        <label for= "exampleInputEmail1">Nombres completos:</label>
        <input type= "text" required class= "form-control" name= "Nombres_cliente" value="<?php echo $Nombres_cliente;?>" id= "Nombres_cliente" aria-describedby= "emailHelp" placeholder= "Digite nombres">
        </div>

        <div class= "form-group">
        <label for= "exampleInputEmail1">Apellidos completos:</label>
        <input type= "text" required class= "form-control" name= "Apellidos_cliente" value="<?php echo $Apellidos_cliente;?>"id= "Apellidos_cliente" aria-describedby= "emailHelp" placeholder= "Digite apellidos">
        </div>

        <div class= "form-group">
        <label for= "exampleInputEmail1">Tipo de documento:</label>
        <input type= "text" required class= "form-control" name= "Tdocumento_cliente" value="<?php echo $Tdocumento_cliente;?>"id= "Tdocumento_cliente" aria-describedby= "emailHelp" placeholder= "Digite tipo de documento">
        </div>

        <div class= "form-group">
        <label for= "exampleInputEmail1">Numero de documento:</label>
        <input type= "text" required class= "form-control" name= "Cedula_cliente" value="<?php echo $Cedula_cliente;?>" id= "Cedula_cliente" aria-describedby= "emailHelp" placeholder= "Digite numero de documento">
        </div>

        <div class= "form-group">
        <label for= "exampleInputEmail1">Direccion de entrega:</label>
        <input type= "text" required class= "form-control" name= "Direccion_cliente" value="<?php echo $Direccion_cliente;?>" id= "Direccion_cliente" aria-describedby= "emailHelp" placeholder= "Digite direccion completa">
        </div>
    
        <div class= "form-group">
        <label for= "exampleInputEmail1">Contacto:</label>
        <input type= "text"  required class= "form-control" name= "Contacto_cliente" value="<?php echo $Contacto_cliente;?>" id= "Contacto_cliente" aria-describedby= "emailHelp" placeholder= "Digite numero de celular">
        </div>  

        <div class= "form-group">
        <label for= "exampleInputEmail1">Fecha registro pedido:</label>
        <input type= "text"  required class= "form-control" name= "Fecha_Registro_pedido" value="<?php echo $Fecha_Registro_pedido;?>" id= "Fecha_Registro_pedido" aria-describedby= "emailHelp" placeholder= "Ingrese la fecha de registro del pedido">
        </div>  

        <div class= "form-group">
        <label for= "exampleInputEmail1">Registre la prioridad del pedido:</label>
        <input type= "text"  required class= "form-control" name= "Prioridad_Pedido" value="<?php echo $Prioridad_Pedido;?>" id= "Prioridad_Pedido" aria-describedby= "emailHelp" placeholder= "Registre la prioridad del pedido">
        </div> 

        <div class= "form-group">
        <label for= "exampleInputEmail1">Registre el estado para el pedido:</label>
        <input type= "text"  required class= "form-control" name= "Estado_Pedido" value="<?php echo $Estado_Pedido;?>" id= "Estado_Pedido" aria-describedby= "emailHelp" placeholder= "Registre el estado ">
        </div> 

        <div class= "form-group">
        <label for= "exampleInputEmail1">Detalle del pedido:</label>
        <input type= "text"  required class= "form-control" name= "Nombre_Producto" value="<?php echo $Nombre_Producto;?>" id= "Nombre_Producto" aria-describedby= "emailHelp" placeholder= "Seleccione los productos">
        </div> 
        
        <div class= "form-group">
        <label for= "exampleInputEmail1">Fecha de entrega del pedido:</label>
        <input type= "text"  required class= "form-control" name= "$Fecha_Entrega_Pedido" value="<?php echo $Fecha_Entrega_Pedido;?>" id= "Fecha_Entrega_Pedido" aria-describedby= "emailHelp" placeholder= "Registra la fecha de entrega del pedido">
        </div> 
        
        
        </div>
        </div>

        <div class="modal-footer">
        <!--botones de formulario-->

        <button type= "submit" name= "accion"  value= "Registrar" <?php echo $accionRegistrar;?> class= "btn btn-success" style= "Margin:8px" >Registrar</button>
        <button type= "submit" name= "accion"  value= "Modificar" <?php echo $accionModificar;?> class= "btn btn-warning" style= "Margin:8px" >Modificar</button>
        <button type= "submit" name= "accion"  value= "Eliminar"  <?php echo $accionEliminar;?> class= "btn btn-danger" style= "Margin:8px" >Eliminar</button>
        <button type= "submit" name= "accion"  value= "Cancelar"  <?php echo $accionCancelar;?> class= "btn btn-primary" style= "Margin:8px" >Cancelar</button>
    
      </div>
    </div>
  </div>
</div>
<!-- Button trigger modal -->   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Registrar Nuevo pedido
        </button>
</form>
<?php
/*consulta de todo los datos en la base de datos-- Tabla principal*/
        $sql =$conexion->prepare("SELECT A.id_Pedido,A.Fecha_Entrega_Pedido ,A.Estado_Pedido, A.Prioridad_Pedido,A.Fecha_Registro_pedido, C.Cedula_cliente,C.Tdocumento_cliente, C.Nombres_cliente, C.Apellidos_cliente,C.Direccion_cliente,C.Contacto_cliente,D.Nombre_Producto FROM pedidos A INNER JOIN detalle_pedido B ON A.id_Pedido =B.id_Detalle_Pedido INNER JOIN cliente C ON A.id_Cliente_P = C.id_Cliente INNER JOIN producto D ON B.id_Producto_D = D.id_Producto");
        $sql ->execute();
        $lista_pedidos=$sql->fetchAll(PDO::FETCH_ASSOC); 
?>
    <div class="row">
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

        <?php foreach($lista_pedidos as $pedido){ ?><!--Resultado de la consulta-->
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
                <th>
            <form method= "post"><!--Boton Seleccionar-->
                
                <input type="hidden" name="Nombres_cliente" value="<?php echo $pedido['Nombres_cliente'];?>">
                <input type="hidden" name="Apellidos_cliente" value="<?php echo $pedido['Apellidos_cliente'];?>">
                <input type="hidden" name="Tdocumento_cliente" value="<?php echo $pedido['Tdocumento_cliente'];?>">
                <input type="hidden" name="Cedula_cliente" value="<?php echo $pedido['Cedula_cliente'];?>">
                <input type="hidden" name="Direccion_cliente" value="<?php echo $pedido['Direccion_cliente'];?>">
                <input type="hidden" name="Contacto_cliente" value="<?php echo $pedido['Contacto_cliente'];?>">
                <input type="hidden" name="Fecha_Registro_pedido" value="<?php echo $pedido['Fecha_Registro_pedido'];?>">
                <input type="hidden" name="Prioridad_Pedido" value="<?php echo $pedido['Prioridad_Pedido'];?>">
                <input type="hidden" name="Estado_Pedido" value="<?php echo $pedido['Estado_Pedido'];?>">
                <input type="hidden" name="Nombre_Producto" value="<?php echo $pedido['Nombre_Producto'];?>">
                <input type="hidden" name="Fecha_Entrega_Pedido" value="<?php echo $pedido['Fecha_Entrega_Pedido'];?>">

                <input type="submit" value="Seleccionar" name ="accion">
                <button type= "submit" name= "accion"  value= "Eliminar" class= "btn btn-info" style= "Margin:8px" >Eliminar</button>
            
        </th>    
            
            </tr>
        <?php } ?>
    </table>
    </form> 
</div>

        <?php if($mostrarvista2){?>
        <script>
            $('#exampleModal').modal('show');
        </script>
        <?php }?>

<?php include ("template/footer.php");?> <!--footer-->
