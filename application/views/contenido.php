<div class="row">
	<?php 
			if(isset($contenido)){
				echo $contenido;
				
			}else{
				redirect("/Inicio/Destacados");
			}

	 ?>	
		
</div>