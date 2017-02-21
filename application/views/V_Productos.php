<div class="container">
    <?php foreach ($productos as $pro) : ?>
        <div class="col-md-12">
            <div class="thumbnail col-md-12">
                <div class="col-md-3">
                    <center>
                        <img src=<?=  base_url()?>assets/img/<?= $pro->Imagen?>.jpg alt="" height="300" width="150">
                    </center>
                </div>
                
                <div class="col-md-8">
                    <h2><a><?= anchor("Inicio/Ver_Producto/{$pro->idProductos}", $pro->Nombre) ?></a></h2>

                    <p><?=$pro->Descripcion?></p>

                     
                        <?php if($pro->Stock > 0){echo "<h4><a class='btn btn-primary pull-right'".  anchor("Inicio/Comprar/{$pro->idProductos}", "Comprar")."</a></h4>";}?>
                     
                    <h3 >Precio: <?=$pro->Precio?>€</h3>

                    <p>
                        <?php if($pro->Stock > 0){echo "<h3 class='pull-right'>Disponible</h3>";}else{echo "<h3 class='pull-right'>Sin Stock</h3>";} ?>
                    </p>
                    
                    

                   
                </div>
                
            </div>
        </div>

    <?php endforeach; ?>
</div>