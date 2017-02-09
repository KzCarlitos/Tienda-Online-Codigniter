<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
 
 
<div class="container">
    <div class="row">
    
     
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Detalles De Pedidos</h3>
                  </div>
                 
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        
                        
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        
                        
                    </tr> 
                  </thead>
                  <tbody>
                       <?php if(isset($Articulos)){
                        $subtotal=0;
                        foreach ($Articulos as $valor):
                          $productos=$this->tienda->Ver_Producto($valor['idProductos']);

                          ?> 



                          <img src="" alt="">

                      <tr>                               
                        <td><img src="<?=  base_url()?>assets/img/<?=$productos->Imagen?>.jpg" height="100" width="60"></td>
                        <td><?=$productos->Nombre?></td>
                        <td><?=$productos->Descripcion?></td>
                        <td><?=$valor['Cantidad']?></td>
                        <td><?=$valor['Precio']?></td>
                        <td class="hidden"><?=$subtotal=$subtotal+($valor['Cantidad']*$valor['Precio'])?></td>
                      </tr>
                      
                    <?php endforeach; } ?>
                          
                    </tbody>
                </table>
                 
              </div>
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Subtotal: <?=$subtotal?> </h3>
                    <h3 class="panel-title">Iva: 21%</h3>
                    <h3 class="panel-title">Total: <?=($subtotal*0.21)+$subtotal?> </h3>
                  </div>
                 
                </div>
              </div>
            </div>
            
   </div>

   
  </div>
</div>