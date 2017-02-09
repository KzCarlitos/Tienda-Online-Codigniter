<?php foreach ($productos as $pro) : ?>
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src=<?=  base_url()?>assets/img/<?= $pro->Imagen?>.jpg alt="" height="300" width="150">
                <div class="caption">
                    <h4 class="pull-right"><?=$pro->Precio?>€</h4>
                    <h4><a><?= anchor("Inicio/Ver_Producto/{$pro->idProductos}", $pro->Nombre) ?></a>
                    </h4>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
