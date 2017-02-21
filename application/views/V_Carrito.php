<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    
     
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Mi Carrito</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <?php echo anchor("Inicio","Seguir Comprando","class='btn btn-sm btn-success btn-create'"); ?>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        
                        <th class="hidden-xs"></th>
                        <th class="col-md-1">Nombre</th>
                        <th>Descripción</th>
                        <th class="col-md-2" >Cantidad</th>
                        <th>Precio</th>
                        <th align="center"><em class="fa fa-cog"></em></th>
                    </tr> 
                  </thead>
                  <tbody>
                  <?php 


                  if(isset($carrito)&& !empty($carrito)){
                  $carro = $carrito->get_content();
                  $precio=0;
                  $subtotal=0;
                  if($carro)
                  {
                      foreach ($carro as $items):?>
                              <tr id="<?=$items['unique_id']?>">

                               
                                  <td class='hidden-xs' align="center"><img src=<?=base_url()?>assets/img/<?=$items['imagen']?>.jpg height='100' width='60'></td>
                                  <td><?=$items['nombre']?></td>
                                  <td><?=$items['descripcion']?></td>
                                  <td>
                                    <center>

                                    <?php if($items['cantidad']>1){echo anchor("Inicio/Quitar/{$items['id']}"," ","class='glyphicon glyphicon-minus'");} ?>                                      
                                    

                                      <?=$items['cantidad']?> 
                                      <?= anchor("Inicio/Comprar/{$items['id']}"," ","class='glyphicon glyphicon-plus '");?>
                                     </center>
   
                                      </td>
                                  <td><?=$items['precio']?></td>
                                  <td align='center'>
                                          
                                          <?= anchor("Inicio/BorraCarrito/{$items['unique_id']}", " ","class='btn btn-danger fa fa-trash'") ?>
                                        </td>
                                 </tr>
                                       <?php 
                               $precio=$items['precio']*$items['cantidad'];
                                $subtotal=$subtotal+$precio;
                        endforeach;
                    }} ?>
                          
                    </tbody>
                </table>
                 <div class="col col-xs-6 text-left">
                    <?php echo anchor("Inicio/BorraTodoCarrito","Vaciar todo","class='btn btn-sm btn-danger btn-create'"); ?>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <?php echo anchor("Inicio/FinalizarCompra","Finalizar Compra","class='btn btn-sm btn-success btn-create'"); ?>
                  </div>
              </div>

               <div class="panel-heading ">
                <div class="row ">
                  <div class="col col-xs-2 pull-right " >
                    <h3 class="panel-title">SubTotal:<?php echo $subtotal;?></h3>
                    <h3 class="panel-title">IVA: 21%</h3>
                    <h3 class="panel-title">Total: <?php echo ($subtotal*0.21)+$subtotal; ?></h3>
                    
                  </div>
                  
                </div>
              </div>
             
            </div>
            
   </div>

   
  </div>
</div>