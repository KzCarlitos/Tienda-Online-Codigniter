 <div align="center">
   
   

   <div style="width: 350px; height:270px; "  class="thumbnail">
     
     
    
     <form method="post">
      <div class="form-group">
        <label for="user">Nombre de Usuario</label>
        <input type="text" class="form-control" id="user" name="usuario">
      </div>
      <div class="form-group">
        <label for="pwd">Contraseña:</label>
        <input type="password" class="form-control" id="pass" name="password">
      </div>
      
      <button type="submit" class="btn btn-success">Acceder</button>
    </form>
    <?php echo anchor("Inicio/Recordar_Contrasena", "¿Olvidaste tu contraseña?","") ?>
    <?php echo validation_errors(); ?>
       <?php if (isset($error)): ?>
         <h3>El usuario no esta registrado o esta dado de baja.</h3>
       <?php endif ?>
  </div>
</div>
  

  
