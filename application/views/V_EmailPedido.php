
<html>
<head><title></title></head>
<body>
 
<h1>Factura Pedido <?=$idPedido?></h1>
 <h3>ID Usuario: <?=$dfactura['idusuario']?></h3>
  <h3>Dirección: <?=$dfactura['direccion']?></h3>
  <h3>Codigo Postal: <?=$dfactura['cp']?></h3>
  <h3>Provincia: <?=$dfactura['Provincia']?></h3>
  





<table>
<tr>
  <td><strong>ID Producto</strong></td>
  <td><strong>Nombre</strong></td>
  <td><strong>Cantidad</strong></td>
  <td><strong>Precio</strong></td>
</tr>

 <?php foreach ($factura  as $value):  ?>
 
  
  <tr>
    
    <td><center><?=$value['idProductos']?></center></td>
    <td><center><?=$value['Nombre']?></center></td>
    <td><center><?=$value['Cantidad']?></center></td>
    <td><center><?=$value['Precio']?></center></td>
    <?php $p_final += ($value['Cantidad'] * $value['Precio'])?>

  </tr>

<?php endforeach; ?>
 
</table>
 

  

 <h3>Subtotal: <?php echo $p_final ." €"; ?></h3>
 <h3>I.V.A: 21%</h3>
 <h3>Total: <?php echo ($p_final*0.21)+$p_final ." €"; ?> </h3>


</body>
</html>

