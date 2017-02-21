<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
 
 
<div class="container">
    <div class="row">
    
     
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Mis Pedidos</h3>
                  </div>
                 
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered ">
                  <thead>
                    <tr>
                        
                        
                        <th>ID Pedido</th>
                        <th>Estado</th>
                        <th>Fecha Pedido</th>
                        
                        <th align="center"><em class="fa fa-cog"></em></th>
                    </tr> 
                  </thead>
                  <tbody>
                       <?php if(isset($ListaP)){
                        foreach ($ListaP as $valor) :?> 

                      <tr>                               
                        <td><?=$valor['idPedidos']?> </td>
                        <td><?=$this->tienda->Convierte_Estado($valor['Estado'])?></td>
                        <td><?=$valor['Fecha_pedido']?></td>
                        <td>
                        <?= anchor("Inicio/Ver_ArticulosP/{$valor['idPedidos']}", " ","class='btn btn-success glyphicon glyphicon-list-alt'") ?>
                        
                        <?php if($valor['Estado']!='C'){echo anchor("Inicio/Anular_Pedido/{$valor['idPedidos']}", " ","class='btn btn-danger glyphicon glyphicon-remove'");} ?>
                        
                        <?= anchor("Inicio/Genera_Pdf/{$valor['idPedidos']}", " ","class='btn btn-danger fa fa-file-pdf-o'") ?>

                           
                          
                        </td>
                      </tr>
                    <?php endforeach; } ?>
                          
                    </tbody>
                </table>
                 
              </div>
             
            </div>
            
   </div>

   
  </div>
</div>