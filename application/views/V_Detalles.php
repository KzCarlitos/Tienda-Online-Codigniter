<div class="container">
    <div class="row">
    
        <ul class="thumbnails">
        
            <li class="span4">
              <div class="thumbnail">
                <img src=<?=  base_url()?>assets/img/<?= $detalles->Imagen?>.jpg alt="" height="300" width="150">
                <div class="caption">
                  <h3><?=$detalles->Nombre?></h3>
                  <p><?=$detalles->Descripcion?></p>
                   <h4>Precio: <?=$detalles->Precio?>€</h4>

                  <p align="center"><a class="btn btn-primary btn-block" <?= anchor("Inicio/Comprar/{$detalles->idProductos}", "Comprar") ?></a></p>
                </div>
              </div>
            </li>
              
            
          
            
           
        </ul>
       
    </div>
</div>