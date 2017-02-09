<?php  
class M_Tienda extends CI_Model{

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function Destacados(){
		$query="Select * From productos Where Destacado ='0' ";
		$Destacados=$this->db->query($query);
		return $Destacados->result();
	}

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

	public function Categoria(){
		$query="Select * from categorias";
		$Categoria=$this->db->query($query);
		return $Categoria->result();
	}

	public function Ver_Categoria($idCategoria){
		$query="Select * From productos Where idCategoria='".$idCategoria."';";
		$Cproductos=$this->db->query($query);
		return $Cproductos->result();
	}


	public function Ver_Producto($idProducto){
		$query="select * from productos where idProductos ='".$idProducto."';";
		$Dproducto=$this->db->query($query);
		return $Dproducto->row();
	}

	public function Comprueba_User($NombreU,$Pass){
		$query="select * from usuarios where usuario= '$NombreU' and contraseña= '$Pass' and baja='0';";
		$User=$this->db->query($query);
		return $User->num_rows();
	}
	public function Datos_User($NombreU){
		// $query="select * from usuarios where usuario= '$NombreU' and contraseña= '$Pass';";
		// $User=$this->db->query($query);
		// return $User->result_array();
		$query = $this->db->get_where('usuarios', array('usuario' => $NombreU));
		return $query->result();
	}

	public function Devuelve_Provincias(){
		$query="select * from provincias ;";
		$provincias=$this->db->query($query);
		return $provincias->result();
	}

	public function Comprueba_NombreUser($NombreU){
		$query="select * from usuarios where usuario='$NombreU';";
		$User=$this->db->query($query);
		return $User->num_rows();
	}

	public function Insertar_Usuario($Datos){

		$this->db->insert('usuarios',$Datos);
	}

	public function Modificar_Usuario($Datos,$id){
		$this->db->where('idUsuarios',$id);
		$this->db->update('usuarios',$Datos);
	}
	
    public function DarBaja($idUsuario){
    	$this->db->set('Baja','1');
    	$this->db->where('idUsuarios',$idUsuario);
    	$this->db->update('usuarios');
    }

    public function Insertar_Pedido($datos){
    	$this->db->insert('pedidos',$datos);
    	return $this->db->insert_id();

    }

     public function Insertar_Articulos($datos){
    	$this->db->insert('articulos',$datos);

    	
    }

    public function Datos_Usuarios($idUser){
		
		$query = $this->db->get_where('usuarios', array('idUsuarios' => $idUser));

		return $query->row();

	}

	public function Ver_Pedidos($id){
		$query = $this->db->get_where('pedidos', array('idUsuarios' => $id));

		return $query->result_array();

	}

	public function Convierte_Estado($estado){
		if($estado=='P'){return "Pendiente";}
		elseif($estado=='C'){return "Cancelado";}
		else{return "Enviado";}
	}

	public function Ver_Articulos($id){
		$query = $this->db->get_where('articulos', array('idPedidos' => $id));

		return $query->result_array();

	}

	public function Anular_pedido($idPedidos){
		$this->db->set('Estado', 'C');
		$this->db->where('idPedidos', $idPedidos);
		$this->db->update('pedidos');
	}


	public function Devuelve_NombreP($idProv){
		$query = $this->db->get_where('provincias', array('idProvincia' => $idProv));

		return $query->row();
	}

	public function Insertar_Productos($datos){
		$this->db->insert("productos",$datos);
	}

	public function Datos_UserEmail($mail){
		
		$query = $this->db->get_where('usuarios', array('Correo' => $mail));
		return $query->row();
	}

	public function LineasPedido($idpedido)
	{
		$sql="SELECT * FROM articulos INNER JOIN productos on articulos.idProductos= productos.idProductos where idPedidos =$idpedido ;";
		$lineas=$this->db->query($sql);
		return $lineas->result_array();
	}

	public function CambiaPass($iduser,$pass){
		$this->db->set('Contraseña', md5($pass));
		$this->db->where('idUsuarios', $iduser);
		$this->db->update('usuarios');

	}

	
}



?>