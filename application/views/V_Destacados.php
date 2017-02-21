<div class="container">
    <?php foreach ($destacados as $des) : ?>
        <div class="col-md-12">
            <div class="thumbnail col-md-12">
                <div class="col-md-3">
                <center>
                <img src=<?=base_url()?>assets/img/<?= $des->Imagen?>.jpg alt="" height="300" width="150">
                </center>
                </div>

                <div class="col-md-8">
                    <h2><a><?= anchor("Inicio/Ver_Producto/{$des->idProductos}", $des->Nombre) ?></a></h2>
                    <p><?=$des->Descripcion?></p>
                     <?php if($des->Stock > 0){echo "<h4><a class='btn btn-primary pull-right'".  anchor("Inicio/Comprar/{$des->idProductos}", "Comprar")."</a></h4>";}?>
                    <h3 >Precio: <?=$des->Precio?>€</h3>

                    <p>
                    <?php if($des->Stock > 0){echo "<h3 class='pull-right'>Disponible</h3>";}else{echo "<h3 class='pull-right'>Sin Stock</h3>";} ?>
                    </p>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
</div>