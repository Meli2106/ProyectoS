<?php include("template/cabecera.php");?> <!--menucabecera-->
<?php include("conexion.php");?> <!--menucabecera-->

<?php /*almacenamiento de datos*/
    $Nombres_cliente =(isset($_POST['Nombres_cliente']))? $_POST['Nombres_cliente']:"";
    $Apellidos_cliente =(isset($_POST['Apellidos_cliente']))? $_POST['Apellidos_cliente']:"";
    $Tdocumento_cliente =(isset($_POST['Tdocumento_cliente']))? $_POST['Tdocumento_cliente']:"";
    $Cedula_cliente =(isset($_POST['Cedula_cliente']))? $_POST['Cedula_cliente']:"";
    $Direccion_cliente =(isset($_POST['Direccion_cliente']))? $_POST['Direccion_cliente']:"";
    $Contacto_cliente =(isset($_POST['Contacto_cliente']))? $_POST['Contacto_cliente']:"";
    $accion =(isset($_POST['accion']))? $_POST['accion']:"";

    $accionRegistrar= "";
    $accionModificar=$accionEliminar=$accionCancelar= "disabled";
    $mostrarvista=false;


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
    header("Location:cliente.php");
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
        header("Location:cliente.php");
    
    break;
        
    /*SQL en la base de datos,borrar de datos*/
    case "Eliminar":
        $sql =$conexion->prepare("DELETE FROM cliente WHERE Cedula_cliente =:Cedula_cliente");
        $sql ->bindParam(':Cedula_cliente',$Cedula_cliente);
        $sql ->execute();
        header("Location:cliente.php");
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
    break;

    case "Seleccionar":
        $accionRegistrar= "disabled";
        $accionModificar=$accionEliminar=$accionCancelar= "";
        $mostrarvista=true;
    break;

    case "Cancelar":
    header("Location:cliente.php");
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
        <h5 class="modal-title" id="exampleModalLabel">Registro Cliente Nuevo</h5>
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
        Registrar Cliente
        </button>
</form>
<?php
/*consulta de todo los datos en la base de datos-- Tabla principal*/
    $sql =$conexion->prepare("SELECT * FROM cliente");
    $sql ->execute();
    $lista_clientes =$sql->fetchAll(PDO::FETCH_ASSOC); 
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
                <th>ACCIONES</th>
            </tr>
        </thead>

        <?php foreach($lista_clientes as $cliente){ ?><!--Resultado de la consulta-->
            <tr>
                <th><?php echo $cliente['id_Cliente'];?></th>
                <th><?php echo $cliente['Nombres_cliente'];?></th>
                <th><?php echo $cliente['Apellidos_cliente'];?></th>
                <th><?php echo $cliente['Tdocumento_cliente'];?></th>
                <th><?php echo $cliente['Cedula_cliente'];?></th>
                <th><?php echo $cliente['Direccion_cliente'];?></th>
                <th><?php echo $cliente['Contacto_cliente'];?></th>
                <th>
            <form action= "" method= "post"><!--Boton Seleccionar-->
                
                <input type="hidden" name="Nombres_cliente" value="<?php echo $cliente['Nombres_cliente'];?>">
                <input type="hidden" name="Apellidos_cliente" value="<?php echo $cliente['Apellidos_cliente'];?>">
                <input type="hidden" name="Tdocumento_cliente" value="<?php echo $cliente['Tdocumento_cliente'];?>">
                <input type="hidden" name="Cedula_cliente" value="<?php echo $cliente['Cedula_cliente'];?>">
                <input type="hidden" name="Direccion_cliente" value="<?php echo $cliente['Direccion_cliente'];?>">
                <input type="hidden" name="Contacto_cliente" value="<?php echo $cliente['Contacto_cliente'];?>">

                <input type="submit" value="Seleccionar" name ="accion">
                <button type= "submit" name= "accion"  value= "Eliminar" class= "btn btn-info" style= "Margin:8px" >Eliminar</button>
            
        </th>    
            
            </tr>
        <?php } ?>
    </table>
    </form> 
</div>
        <?php if($mostrarvista){?>
        <script>
            $('#exampleModal').modal('show');
            header("Location:cliente.php");
        </script>
        <?php }?>

</body>
</html>

<?php include ("template/footer.php");?> <!--footer-->