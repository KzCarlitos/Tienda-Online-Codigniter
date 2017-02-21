<div class="container">
  <div class="row">




    <div class="thumbnail col-md-12">
     <div class="col-md-6"> 
      <center>               
        <img src=<?=  base_url()?>assets/img/<?= $detalles->Imagen?>.jpg alt="" height="300" width="150">
      </center>
    </div>

    <div class="col-md-6">
     <h3><?=$detalles->Nombre?></h3>
     <p><?=$detalles->Descripcion?></p>
     <h4>Precio: <?=$detalles->Precio?>€</h4>
     <h4>Stock: <?=$detalles->Stock?></h4>

   </div>

   <p align="right"> <?= anchor("Inicio/Comprar/{$detalles->idProductos}", "Comprar","class='btn btn-primary " . $disabled . "'") ?></p>
 </div>
</div>
</div>