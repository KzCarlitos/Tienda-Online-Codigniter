<div id="categoria" align="center">
<?php foreach ($categoria as $cate): ?>
              
      <a class="btn btn-primary btn-lg btn-block" align="center"
         <?= anchor("Inicio/ver_categoria/{$cate->idCategoria}", $cate->Nombre) ?>
      </a>
     <br>
<?php endforeach; ?>
</div>