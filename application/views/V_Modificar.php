
 <!--Este es el mensaje mondal de confirmacion-->

   <div id="example" class="modal fade">
   <div class="modal-dialog">   
      <div class="modal-content"> 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <h3>¿Estas seguro que quieres darte de baja?</h3>
         </div>
         <div class="modal-body">
            
            <p>Si confirmas la baja seras desconectado del sistema y solo un administrador
            podra volver habilitarte la cuenta para volver a conectarte.</p>                
         </div>
         <div class="modal-footer">
          
            <?= anchor("Inicio/DarBaja/{$_SESSION['idUser']}",'Confirmar','class="btn btn-danger"')?>
            <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
         </div>
    </div>
   </div>
</div>


<form class="form-horizontal" method="POST">
  <fieldset>

  <!-- Form Name -->
  <legend style="margin-left: 2%;">Datos Personales</legend>

   <?php echo validation_errors(); ?>

       
<?php foreach ($Datos as  $valor) :?>

  <input id="ID" name="ID" type="hidden" placeholder="ID" class="form-control input-md" required="" value="<?=$valor->idUsuarios?>">
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Nombre">Nombre</label>  
    <div class="col-md-5">
    <input id="Nombre" name="Nombre" type="text" placeholder="Nombre" class="form-control input-md" required="" value="<?=$valor->Nombre?>">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Apellidos">Apellidos</label>  
    <div class="col-md-5">
    <input id="Apellidos" name="Apellidos" type="text" placeholder="Apellidos" class="form-control input-md" required="" value="<?=$valor->Apellidos?>">
      
    </div>
  </div>

<div class="form-group">
    <label class="col-md-4 control-label" for="DNI">DNI</label>  
    <div class="col-md-5">
    <input id="DNI" name="DNI" type="text" placeholder="DNI" class="form-control input-md" required="" value="<?=$valor->DNI?>">
      
    </div>
  </div>


  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Correo">Correo</label>  
    <div class="col-md-5">
    <input id="Correo" name="Correo" type="text" placeholder="Correo" class="form-control input-md" value="<?=$valor->Correo?>" readonly="readonly">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Usuario">Nombre de Usuario</label>  
    <div class="col-md-4">
    <input id="Usuario" name="Usuario" type="text" placeholder="Usuario" class="form-control input-md" required="" value="<?=$valor->Usuario?>" readonly="readonly">
      
    </div>
  </div>
<!-- Contraseña 
   <div class="form-group">
    <label class="col-md-4 control-label" for="Contraseña">Contraseña</label>  
    <div class="col-md-4">
    <input id="Contraseña" name="Contraseña" type="password" placeholder="Contraseña" class="form-control input-md" required="" value="<?=$valor->Contraseña?>">
      
    </div>
  </div>
-->


  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="CP">Codigo Postal</label>  
    <div class="col-md-4">
    <input id="CP" name="CP" type="text" placeholder="CP" class="form-control input-md"
    value="<?=$valor->CP?>">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Direccion">Direccion</label>  
    <div class="col-md-4">
    <input id="Direccion" name="Direccion" type="text" placeholder="Direccion" class="form-control input-md" value="<?=$valor->Direccion?>">
      
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Provincia">Provincia</label>
    <div class="col-md-4">
      <select id="Provincia" name="Provincia" class="form-control">
      <?php foreach ($provincias as $Pro) {
        if($valor->idProvincia == $Pro->idProvincia)
          {
            echo "<option value='".$Pro->idProvincia."' Selected>".$Pro->Nombre."</option>";
          }
          else
          {
          echo "<option value='".$Pro->idProvincia."''>".$Pro->Nombre."</option>";
          }
        }
        

       ?>
        
      </select>
    </div>
  </div>

<?php endforeach; ?>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Modificar">Modificar</label>
    <div class="col-md-4">
      <button id="Modificar" name="Modificar" class="btn btn-success">Modificar</button>
      <a data-toggle="modal" href="#example" class="btn btn-danger btn-large">Dar de baja</a>
    </div>
  </div>

</form>

