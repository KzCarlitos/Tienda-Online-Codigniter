<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Bootstrap Core JavaScript -->
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Bootstrap Core CSS -->
    
    <link href="<?=  base_url()?>assets/css/style.css" rel="stylesheet">

   
    

    <!-- Custom CSS -->
    <link href="<?=  base_url()?>assets/css/business-casual.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=  base_url()?>assets/css/business-casual.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<body>

 
    <center>
  
     <div style="width: 350px; height:270px; "  class="thumbnail">
     
     
    
     <form method="post">
      <div class="form-group">
        <label for="mail">Email</label>
        <input type="text" class="form-control" id="mail" name="email">
      </div>
      
      
      <button type="submit" class="btn btn-success">Enviar</button>
    </form>
   
    <?php echo validation_errors(); ?>
       <?php if (isset($enviado)): ?>
         <h3>El correo se ha enviado correctamente.</h3>
         <p>Pincha aqui para ir a la <?=anchor('Inicio/', 'tienda');?><tienda</p>
       <?php endif; ?>
  </div>

</center>

</div>

</body>
</html>

   
   

