<form method="post">
 
  <fieldset>

  <!-- Form Name -->
  <legend style="margin-left: 2%;">Bienvenido rellene el formulario</legend>

</fieldset>
<div class="container">




    <div class="panel panel-default">
     <div class="panel-body">
        
      

       

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Nombre">Nombre</label>  
    <div class="col-md-5">
    <input id="Nombre" name="Nombre" type="text" placeholder="Nombre" class="form-control input-md" value="<?=set_value('Nombre')?>" >
    
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Nombre');?>
    </div>
  </div>
<br/>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Apellidos">Apellidos</label>  
    <div class="col-md-5">
    <input id="Apellidos" name="Apellidos" type="text" placeholder="Apellidos" class="form-control input-md" value="<?=set_value('Apellidos')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Apellidos');?>
    </div>
  </div>
<br/>
<div class="form-group">
    <label class="col-md-3 control-label" for="DNI">DNI</label>  
    <div class="col-md-5">
    <input id="DNI" name="DNI" type="text" placeholder="DNI" class="form-control input-md" values="<?=set_value('DNI')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('DNI');?>
    </div>
  </div>

<br/>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Correo">Correo</label>  
    <div class="col-md-5">
    <input id="Correo" name="Correo" type="text" placeholder="Correo" class="form-control input-md" value="<?=set_value('Correo')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Correo');?>
    </div>
  </div>
<br/>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Usuario">Nombre de Usuario</label>  
    <div class="col-md-5">
    <input id="Usuario" name="Usuario" type="text" placeholder="Usuario" class="form-control input-md" value="<?=set_value('Usuario')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Usuario');?>
    </div>
  </div>
<br/>
   <div class="form-group">
    <label class="col-md-3 control-label" for="Contraseña">Contraseña</label>  
    <div class="col-md-5">
    <input id="Contraseña" name="Contraseña" type="password" placeholder="Contraseña" class="form-control input-md" value="<?=set_value('Contraseña')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Contraseña');?>
    </div>
  </div>
<br/>


  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="CP">Codigo Postal</label>  
    <div class="col-md-5">
    <input id="CP" name="CP" type="text" placeholder="CP" class="form-control input-md" value="<?=set_value('CP')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('CP');?>
    </div>
  </div>
<br/>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Direccion">Direccion</label>  
    <div class="col-md-5">
    <input id="Direccion" name="Direccion" type="text" placeholder="Direccion" class="form-control input-md" value="<?=set_value('Direccion')?>">
      
    </div>
    <div class="col-md-4">
      <?php  echo form_error('Direccion');?>
    </div>
  </div>
<br/>
  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-3 control-label" for="Provincia">Provincia</label>
    <div class="col-md-5">
      <select id="Provincia" name="Provincia" class="form-control">
      <?php foreach ($provincias as $valor) {
          echo "<option value='".$valor->idProvincia."''>".$valor->Nombre."</option>";

      } ?>
        
      </select>
    </div>
  </div>

<br/>

  <!-- Button -->
  <div class="form-group">
   
    <div class="col-md-5">
      <button type="submit" id="Registrarse" name="Registrarse" class="btn btn-danger">Registrarse</button>

    </div>
  </div>
</div>  
</div>
</div>
<?php echo form_close(); ?>