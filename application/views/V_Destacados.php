<div class="container">
    <?php foreach ($destacados as $des) : ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src=<?=base_url()?>assets/img/<?= $des->Imagen?>.jpg alt="" height="300" width="150">
                <div class="caption">
                    <h4 class="pull-right"><?=$des->Precio?>€</h4>
                    <h4><a><?= anchor("Inicio/Ver_Producto/{$des->idProductos}", $des->Nombre) ?></a>
                    </h4>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
</div>