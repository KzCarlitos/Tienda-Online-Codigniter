<?php  
class M_Tienda extends CI_Model{

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    /*--------------- FUNCIONES SOBRE LA TIENDA PARA PRODUCTOS Y CATEGORIAS ----------------*/

    /*Obtiene todos los productos que estan como destacados.
	* return Devuelve array con todo los productos
    */

	public function Destacados(){
		$query="Select * From productos Where Destacado ='0' ";
		$Destacados=$this->db->query($query);
		return $Destacados->result();
	}

	/*Realiza la misma funcion que la anterior
	* @param $por_pagina Son los elementos que se van a mostrar en la pagina.
	* @param $comienzo Es la pagina por la cual empieza a buscar elementos.
	* return Devuelve array con todos los productos para cada pagina.
	*/
	public function Destacados_P($por_pagina,$comienzo){
		$query="Select * From productos Where Destacado ='0' LIMIT $comienzo, $por_pagina ";
		$Destacados=$this->db->query($query);
		return $Destacados->result();
	}


	public function Destacados_Filas(){
		$query="Select * From productos Where Destacado ='0'";
		$Destacados=$this->db->query($query);
		return $Destacados->num_rows();
	}


	/*Devuelve todas las categoria.
	* Return devuelve array con todas las categorias.
	*/
	public function Categoria(){
		$query="Select * from categorias";
		$Categoria=$this->db->query($query);
		return $Categoria->result();
	}

	/*Devuelve todos los productos de una categoria especifica
	* @Param Se le pasa el id de cada categoria.
	* @Return Devuelve un array con los productos perteneciente a esa categoria.
	*/
	public function Ver_Categoria($idCategoria){
		$query="Select * From productos Where idCategoria='".$idCategoria."';";
		$Cproductos=$this->db->query($query);
		return $Cproductos->result();
	}

	/*Devuelve los datos del producto seleccionado.
	* @Param se le pasa el id del producto.
	* @Return Devuelve una sola fila con los datos del productos.
	*/
	public function Ver_Producto($idProducto){
		$query="select * from productos where idProductos ='".$idProducto."';";
		$Dproducto=$this->db->query($query);
		return $Dproducto->row();
	}

	/*Devuelve todas las provincias de la base de datos.
	* @Return Devuelve un array con todos los datos de todas las provincias.
	*/
	public function Devuelve_Provincias(){
		$query="select * from provincias ;";
		$provincias=$this->db->query($query);
		return $provincias->result();
	}

	/*Inserta un nuevo producto
	* @Param se le pasa un array con los datos del producto que vas añadir.
	*/
	public function Insertar_Articulos($datos){
    	$this->db->insert('articulos',$datos);
	
    }

    /*Recupera los datos de la tabla articulos-
	* @Param Se le pasa el id del pedido para recuperar todos los aticulos de un pedido.
	* @Return Devuelve un array con todos los articulos de ese pedido.

    */
    public function Ver_Articulos($id){
		$query = $this->db->get_where('articulos', array('idPedidos' => $id));

		return $query->result_array();

	}

	/*Inserta un nuevos productos en la base de datos
	* @Param se le pasa un array con los nuevos productos.
	*/
	public function Insertar_Productos($datos){
		$this->db->insert("productos",$datos);
	}


	/*-------------------------------------------------------O-------------------------------------------------------------*/






	/*----------------------------- FUNCIONES DE USUARIOS -----------------------------*/

	/*Comprueba si el nombre de usuario y la contraseña son correctos.
	* @Param NombreU es el nombre del usuario. 
	* @Param Pass es la contraseña del usuario.
	* @Return devuelve una fila si con los resultado en caso de que sea correcto.
	*/
	public function Comprueba_User($NombreU,$Pass){
		$query="select * from usuarios where usuario= '$NombreU' and contraseña= '$Pass' and baja='0';";
		$User=$this->db->query($query);
		return $User->num_rows();
	}

	/* Devuelve los datos del usuario.
	* @Param Es el nombre del usuario.
	* @Return Devuelve un array con todos los datos del usuario pasado por parametro.
	*/
	public function Datos_User($NombreU){
		$query = $this->db->get_where('usuarios', array('usuario' => $NombreU));
		return $query->result();
	}

	/* Comprueba que el nombre de usuario existe en la base de datos.
	* @Param NombreU es el nombre del usuarioa a comprobar.
	* @Return Devuelva el numeor de usuario que coincide con ese usuario.
	*/
	public function Comprueba_NombreUser($NombreU){
		$query="select * from usuarios where usuario='$NombreU';";
		$User=$this->db->query($query);
		return $User->num_rows();
	}

	/* Registar un nuevo usuario en la base de datos.
	* @Param Es un array con todos los datos del usuario.
	*/
	public function Insertar_Usuario($Datos){

		$this->db->insert('usuarios',$Datos);
	}


	/*Realiza modificaciones en los datos del usuario.
	* @Param Datos es el array con todos los datos modificados.
	* @Param ID es el id del usuario el cual vamos a modificar los datos.
	*/
	public function Modificar_Usuario($Datos,$id){
		$this->db->where('idUsuarios',$id);
		$this->db->update('usuarios',$Datos);
	}

	/*Realiza la funcion de dar de baja al usuario.
	*@Param idusuario es el codigo por el cual se indetifica al usuario.
	*/
    public function DarBaja($idUsuario){
    	$this->db->set('Baja','1');
    	$this->db->where('idUsuarios',$idUsuario);
    	$this->db->update('usuarios');
    }


    /*Se obtiene todos los datos del usuario mediante su id.
    * @Param iduser es el codigo que identifica al usuario.
    * @Return devuelve una fila con todos los datos del usuario.
    */
    public function Datos_Usuarios($idUser){
		
		$query = $this->db->get_where('usuarios', array('idUsuarios' => $idUser));

		return $query->row();

	}

	/*Cambia la contraseña del usuario y la introduce en la base de datos
	* @Param iduser es el codigo que identifica al usuario.
	* @Param pass  es la contraseña nueva del usuario.
	*/
	public function CambiaPass($iduser,$pass){
		$this->db->set('Contraseña', md5($pass));
		$this->db->where('idUsuarios', $iduser);
		$this->db->update('usuarios');

	}

	/*Devuelve los datos del usuario en funcion del correo electronico
	* @Param mail es el correo con el que esta registrado el usuario.
	* @Return Devuelve el array con los datos del usuario.
	*/
	public function Datos_UserEmail($mail){
		
		$query = $this->db->get_where('usuarios', array('Correo' => $mail));
		return $query->row();
	}

	/*-------------------------------------------------------O-------------------------------------------------------------*/





	/*---------------------------FUNCIONES SOBRE PEDIDOS -----------------------------*/

    /* Inserta un nuevo pedido en la base de datos.
	* @Param datos son los datos del pedido.
	* @Return devuelve el id del pedido creado en la inserccion.
    */
    public function Insertar_Pedido($datos){
    	$this->db->insert('pedidos',$datos);
    	return $this->db->insert_id();

    }

    /*Recupera los datos del pedido dependiendo del usuario
	*@Param id es el id que identifica al usuario.
	*@Return devuelve array con todos los datos del pedido del usuario.
    */
	public function Ver_Pedidos($id){
		$query = $this->db->get_where('pedidos', array('idUsuarios' => $id));

		return $query->result_array();

	}

	/*Convierte el estado C,P,E con sus respectivos mensajes.
	* @Param Estado es el estado en el que se encuentra el pedido.
	* @Return Devuelve el mensaje segun el estado en el que se encuentre.
	*/
	public function Convierte_Estado($estado){
		if($estado=='P'){return "Pendiente";}
		elseif($estado=='C'){return "Cancelado";}
		else{return "Enviado";}
	}


	/*Cambia el estado de pedido a cancelado
	* @Param idpedido es el identificador del pedido.
	*/
	public function Anular_pedido($idPedidos){
		$this->db->set('Estado', 'C');
		$this->db->where('idPedidos', $idPedidos);
		$this->db->update('pedidos');
	}

	/*Devuelve el nombre de la provincia.
	*@Param idprov es el identificador de la provincia.
	*@return Devuelve el nombre de la provincia.
	*/
	public function Devuelve_NombreP($idProv){
		$query = $this->db->get_where('provincias', array('idProvincia' => $idProv));

		return $query->row();
	}

	/*Devuelve los los articulos de un pedido con sus productos correcpondeientes.
	* @Param Idpedido es el identificador del pedido.
	* @Return Devuelve los datos del pedido.
	*/
	public function LineasPedido($idpedido)
	{
		$sql="SELECT * FROM articulos INNER JOIN productos on articulos.idProductos= productos.idProductos where idPedidos =$idpedido ;";
		$lineas=$this->db->query($sql);
		return $lineas->result_array();
	}

	
	/*-------------------------------------------------------O-------------------------------------------------------------*/

	
}



?>