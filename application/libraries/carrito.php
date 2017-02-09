<?php 



 
class Carrito
{
 
	//aquí guardamos el contenido del carrito
	private $articulos = array();
	
 

	//reseteamos el articulos exista o no exista en el constructor
	public function __construct()
	{
		$ci=&get_instance();
		$ci->load->library('session');
		
		if(!isset($_SESSION["carrito"]))
		{
			$_SESSION["carrito"] = array();
		}
		$this->articulos = $_SESSION['carrito'];
	}
 
	//añadimos un producto al carrito
	public function add($articulo = array())
	{
		//primero comprobamos el articulo a añadir, si está vacío o no es un 
		//array lanzamos una excepción y cortamos la ejecución
		if(!is_array($articulo) || empty($articulo))
		{
			throw new Exception("Error, el articulo no es un array!", 1);	
		}
 
		//nuestro carro necesita siempre un id producto, cantidad y precio articulo
		if(!$articulo["id"] || !$articulo["cantidad"] || !$articulo["precio"])
		{
			throw new Exception("Error, el articulo debe tener un id, cantidad y precio!", 1);	
		}
 
		//nuestro carro necesita siempre un id producto, cantidad y precio articulo
		if(!is_numeric($articulo["id"]) || !is_numeric($articulo["cantidad"]) || !is_numeric($articulo["precio"]))
		{
			throw new Exception("Error, el id, cantidad y precio deben ser números!", 1);	
		}
 
		//debemos crear un identificador único para cada producto
		$unique_id = md5($articulo["id"]);
 
		//creamos la id única para el producto
		$articulo["unique_id"] = $unique_id;
		
		//evitamos que nos pongan números negativos y que sólo sean números para cantidad y precio
		//$articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
	    $articulo["precio"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["precio"]));

		//si no está vacío el carrito lo recorremos 
		if(isset($this->articulos[$unique_id]))
		{
			$this->articulos[$unique_id]['cantidad']=$this->articulos[$unique_id]["cantidad"] + $articulo["cantidad"];
		}
		else {
			$this->articulos[$unique_id]=$articulo;
		}

	    //actualizamos el carrito
	    $this->update_carrito();
	}
 

 
	//método que retorna el precio total del carrito
	public function precio_total()
	{
		//si no está definido el elemento precio_total o no existe el carrito
		//el precio total será 0
		if(!isset($this->articulos["precio_total"]) || $this->articulos === null)
		{
			return 0;
		}
		//si no es númerico lanzamos una excepción porque no es correcto
		if(!is_numeric($this->articulos["precio_total"]))
		{
			throw new Exception("El precio total del carrito debe ser un número", 1);	
		}
		//en otro caso devolvemos el precio total del carrito
		return $this->articulos["precio_total"] ? $this->articulos["precio_total"] : 0;
	}
 
	//método que retorna el número de artículos del carrito
	public function articulos_total()
	{
		//si no está definido el elemento articulos_total o no existe el carrito
		//el número de artículos será de 0
		if(!isset($this->articulos["articulos_total"]) || $this->articulos === null)
		{
			return 0;
		}
		//si no es númerico lanzamos una excepción porque no es correcto
		if(!is_numeric($this->articulos["articulos_total"]))
		{
			throw new Exception("El número de artículos del carrito debe ser un número", 1);	
		}
		//en otro caso devolvemos el número de artículos del carrito
		return $this->articulos["articulos_total"] ? $this->articulos["articulos_total"] : 0;
	}
 
	//este método retorna el contenido del carrito
	public function get_content()
	{
		return $this->articulos;
	}
 
 
	//para eliminar un producto debemos pasar la clave única
	//que contiene cada uno de ellos
	public function remove_producto($unique_id)
	{
		//si no existe el carrito
		if($this->articulos === null)
		{
			throw new Exception("El carrito no existe!", 1);
		}
 
		//si no existe la id única del producto en el carrito
		if(!isset($this->articulos[$unique_id]))
		{
			return false;
			throw new Exception("La unique_id $unique_id no existe!", 1);
		}
 
		//en otro caso, eliminamos el producto, actualizamos el carrito y 
		//el precio y cantidad totales del carrito
		unset($this->articulos[$unique_id]);
		$this->update_carrito();
		return true;
	}
 
	//eliminamos el contenido del carrito por completo
	public function destroy()
	{
		unset($_SESSION["carrito"]);
		$this->articulos = null;
		return true;
	}
 
	//actualizamos el contenido del carrito
	public function update_carrito()
	{
		$_SESSION['carrito']=$this->articulos;
	}

	public function remove_items($articulo = array()){

		$unique_id = md5($articulo["id"]);
 
		//creamos la id única para el producto
		$articulo["unique_id"] = $unique_id;
		
		//evitamos que nos pongan números negativos y que sólo sean números para cantidad y precio
		//$articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
	    $articulo["precio"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["precio"]));

		if(isset($this->articulos[$unique_id]))
		{
			$this->articulos[$unique_id]['cantidad']=$this->articulos[$unique_id]["cantidad"] - $articulo["cantidad"];
		}
		else {
			$this->articulos[$unique_id]=$articulo;
		}

	    //actualizamos el carrito
	    $this->update_carrito();

	}

}




 ?>