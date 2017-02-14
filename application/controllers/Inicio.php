<?php 
class Inicio extends CI_Controller{

	public function index()
	{
	 
	 $this->load->view('header');
	 $this->load->view('menu');
	 $this->load->view('contenido');
	 $this->load->view('pie');

	

	}
	/*Se encarga de cargar las distintas vista con los parametros correspondiente.
	*@Param Contenido son los datos pasados a las distintas vistas.
	*/
	public function cargaVista($contenido){
		$this->load->view('header');
		 $this->load->view('menu');
		 $this->load->view('contenido',$contenido);
		 $this->load->view('pie');
	}


	/*----------------------------------------FUNCIONES RELACIONADA CON LA TIENDA, PRODUCTOS Y CATEGORIAS.---------------------------------------*/

	/*Carga todos los productos que sean destacado y realiza la paginacion de ellos.
	*/
	public function Destacados(){
		$this->load->model("M_Tienda","tienda");
		$pages=3; //Número de registros mostrados por páginas
         
        $config['base_url'] = site_url('Inicio/Destacados/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tienda->Destacados_Filas();//calcula el número de filas
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 2; //Número de links mostrados en la paginación
        $config["uri_segment"] = 3;//el segmento de la paginación
        $comienzo = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		
        $this->pagination->initialize($config); //inicializamos la paginación


		//$this->load->model("M_Tienda","tienda");
		$destacados=$this->tienda->Destacados_P($config['per_page'],$comienzo);
		
		$contenido = $this->load->view('V_Destacados', Array('destacados' => $destacados), true);
		 	
	 	
	 	$this->cargaVista(Array('contenido' => $contenido));


	}


	/*Realiza la carga de todas las categorias que existen.
	*/
	public function Categoria(){
		$this->load->model("M_Tienda","tienda");
		$categoria=$this->tienda->Categoria();
		
		$contenido = $this->load->view('V_Categoria', Array('categoria' => $categoria), true);
		 	
	 	
	 	$this->cargaVista(Array('contenido' => $contenido));

	}


	/*Realiza la carga de la categoria selecionada
	*@Param idcategoria es el identificador de la categoria.
	*/
	public function Ver_Categoria($idCategoria){
		$this->load->model("M_Tienda","tienda");
		$productos=$this->tienda->Ver_Categoria($idCategoria);

		$contenido = $this->load->view('V_Productos', Array('productos' => $productos), true);
		 	
	 	
	 	$this->cargaVista(Array('contenido' => $contenido));

	}

	/*Realiza la carga del producto selecionado
	*@Param idproducto es el identificador del producto seleccionado.
	*/
	public function Ver_Producto($idProducto){
		$this->load->model("M_Tienda","tienda");
		$detalles=$this->tienda->Ver_Producto($idProducto);

		$contenido=$this->load->view('V_Detalles',Array('detalles'=>$detalles),true);
		$this->cargaVista(Array('contenido'=>$contenido));
	}



	/*--------------------------------------------------------------------O-------------------------------------------------------------*/



	/*-------------------------------------------- FUNCIONES SOBRE LOS USUARIOS ------------------------------------------*/


	/*Se encarga de comprobar el acceso a la web y cargar los datos del usuario
	*/
	public function Loguearse(){
		$this->load->model("M_Tienda","tienda");
		

		$this->form_validation->set_rules('usuario', 'usuario', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$contenido=$this->load->view('V_Login','',true);
			$this->cargaVista(Array('contenido'=>$contenido));
		}
		else
		{
			$user=$this->input->post('usuario');
			$password=$this->input->post('password');
			$UserValido= $this->tienda->Comprueba_User($user,md5($password));

			if($UserValido==1){
				$DatosUser= $this->tienda->Datos_User($user);
				$this->session->set_userdata('Usuario_Valido', true);
				$this->session->set_userdata('Datos_Usuario', $DatosUser);
				$this->session->set_userdata('idUser',$DatosUser[0]->idUsuarios);
				$this->Destacados();

				//$this->cargaVista(Array('contenido'=>'Perfecto'));
			}else{
				$contenido=$this->load->view('V_Login',array('error' => true),true);
				$this->cargaVista(Array('contenido'=>$contenido));
			}

		}

		
	}

	/*Se encarga de salir de la sesion del usuario y borrar los datos de la misma.
	*/
	public function Salir(){
		$this->load->model("M_Tienda","tienda");
		
		$this->session->unset_userdata('Datos_Usuario');
		$this->session->unset_userdata('Usuario_Valido');
		$this->session->unset_userdata('idUser');
		$this->index();
	}

	/*Se encarga del registro de un nuevo usuario, recoge los datos y los envia a la base de datos.
	*/
	public function Registro(){
		$this->load->model("M_Tienda","tienda");

		// Seguir por aqui no sale los errores 
		
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('DNI', 'DNI', 'required|trim|valid_dni|is_unique[usuarios.DNI]');
		$this->form_validation->set_rules('Correo', 'Correo', 'required|valid_email|trim');
		$this->form_validation->set_rules('Usuario', 'Usuario', 'required|is_unique[usuarios.Correo]');
		$this->form_validation->set_rules('Contraseña','Contraseña','required|trim');
		$this->form_validation->set_rules('CP', 'CP', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('Direccion', 'Direccion', 'required');


		$this->form_validation->set_message('required', 'Debes rellenar el campo %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('valid_email', 'Debe escribir una dirección de email correcta');
		$this->form_validation->set_message('valid_dni', 'El %s no tiene el formato valido');
		$this->form_validation->set_message('is_unique', 'El %s ya esta registrado');

		if ($this->form_validation->run() == FALSE)
		{

		$provincias=$this->tienda->Devuelve_Provincias();
		$contenido=$this->load->view('V_Registro',Array('provincias'=>$provincias,'error'=>true),true);
		$this->cargaVista(Array('contenido'=>$contenido));

		}
		else
		{
				
					$Nombre=$this->input->post('Nombre');
					$Apellidos=$this->input->post('Apellidos');
					$DNI=$this->input->post('DNI');
					$Correo=$this->input->post('Correo');
					$Usuario=$this->input->post('Usuario');
					$Contraseña=$this->input->post('Contraseña');
					$CP=$this->input->post('CP');
					$Direccion=$this->input->post('Direccion');
					$Provincia=$this->input->post('Provincia');

				$Datos=array(
					'Nombre' =>$Nombre,
					'Apellidos'=>$Apellidos,
					'DNI'=>$DNI,
					'Correo'=>$Correo,
					'Usuario'=>$Usuario,
					'Contraseña'=>md5($Contraseña),
					'CP'=>$CP,
					'Direccion'=>$Direccion,
					'idProvincia'=>$Provincia
					 );

				$this->tienda->Insertar_Usuario($Datos);
				$DatosUser= $this->tienda->Datos_User($user);
				$this->session->set_userdata('Usuario_Valido', true);
				$this->session->set_userdata('Datos_Usuario', $DatosUser);
				$this->index();
		}

	}

	/*Se encarga de recoger los datos que han sido modificados y actulizarlo en la base de datos.
	*/
	public function Modificar(){
		$this->load->model("M_Tienda","tienda");

		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('DNI', 'DNI', 'required|trim|valid_dni');
		$this->form_validation->set_rules('Correo', 'Correo', 'required|valid_email|trim');
		$this->form_validation->set_rules('Usuario', 'Usuario', 'required');
		//$this->form_validation->set_rules('Contraseña','Contraseña','required|trim');
		$this->form_validation->set_rules('CP', 'CP', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('Direccion', 'Direccion', 'required');


		$this->form_validation->set_message('required', 'Debes rellenar el campo %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('valid_email', 'Debe escribir una dirección de email correcta');
		$this->form_validation->set_message('valid_dni', 'El %s no tiene el formato valido');



			if ($this->form_validation->run() == FALSE)
		{
			$provincias=$this->tienda->Devuelve_Provincias();
			$contenido=$this->load->view('V_Modificar',Array('provincias'=>$provincias,'Datos'=>$_SESSION['Datos_Usuario']),true);
			$this->cargaVista(Array('contenido'=>$contenido));
		}
		else
		{
				$idUsuario=$this->input->post('ID');
				$Nombre=$this->input->post('Nombre');
				$Apellidos=$this->input->post('Apellidos');
				$DNI=$this->input->post('DNI');
				$Correo=$this->input->post('Correo');
				$Usuario=$this->input->post('Usuario');
				//$Contraseña=$this->input->post('Contraseña');
				$CP=$this->input->post('CP');
				$Direccion=$this->input->post('Direccion');
				$Provincia=$this->input->post('Provincia');

				$Datos=array(
					'Nombre' =>$Nombre,
					'Apellidos'=>$Apellidos,
					'DNI'=>$DNI,
					'Correo'=>$Correo,
					'Usuario'=>$Usuario,
					
					'CP'=>$CP,
					'Direccion'=>$Direccion,
					'idProvincia'=>$Provincia
				 );
				
				$this->tienda->Modificar_Usuario($Datos,$idUsuario);
				$DatosUser= $this->tienda->Datos_User($Usuario);
				$this->session->unset_userdata('Datos_Usuario');
				$this->session->set_userdata('Datos_Usuario', $DatosUser);
				$this->index();
		}

		
	}

	/* Se encarga de dar de baja al usuario en nuestra web.
	*@Param idusuario es el identificador por el cual sabemos que usuario es.
	*/
	public function DarBaja($idUsuario){
		$this->load->model("M_Tienda","tienda");
		$this->tienda->DarBaja($idUsuario);
		$this->Salir();

	}


	/*Devuelve el nombre de la porvincia
	*@Param idprovincia identifica la provincia de la que devuelve el nombre.
	*@Return Devuelve el nombre de la provincia.
	*/
	public function Nombre_Provincia($idProvincia){
		$this->load->model("M_Tienda","tienda");
		$nombre = $this->tienda->Devuelve_NombreP($idProvincia);
		return $nombre;
	}

	/*------------------------------------------------------------O----------------------------------------------------------------*/





	/*-------------------------------------------- FUNCIONES SOBRE EL CARRITO DE LA TIENDA ----------------------------------------*/

	/*Se encarga de visualizar el contenido del carrito en caso de que exista.
	*/
	public function Carrito(){
		$this->load->model("M_Tienda","tienda");
		if(isset($_SESSION['carrito'])){
		$contenido=$this->load->view('V_Carrito',Array('carrito'=>$this->carrito),true);
		$this->cargaVista(Array('contenido'=>$contenido));

		}else{
			$contenido=$this->load->view('V_Carrito',Array('carrito'=>""),true);
		$this->cargaVista(Array('contenido'=>$contenido));
		}


	}

	/*Es la funcion encargada de añadir un producto al carrito.
	*@Param id producto identifica el producto para poder añadirlo al carrito.
	*/
	public function Comprar($idProducto){

		// primero se añade al carrito y luego se muestra el carrito.
		$this->load->model("M_Tienda","tienda");
		$Producto=$this->tienda->Ver_Producto($idProducto);
		$articulo=[];
		
		
		$articulo = array(
			"id"			=>		$idProducto,
			"cantidad"		=>		1,
			"precio"		=>		$Producto->Precio,
			"nombre"		=>		$Producto->Nombre,
			"descripcion"	=>		$Producto->Descripcion,
			"imagen"		=>		$Producto->Imagen
		);
		

		$this->carrito->add($articulo);		
		$contenido=$this->load->view('V_Carrito',Array('carrito'=>$this->carrito) ,true);
		$this->cargaVista(Array('contenido'=>$contenido));

	}

	/*Se encarga de eliminar un producto del carrito.
	*@Param id es el identificador del producto creado cuando se añadio al carrito.
	*/
	public function BorraCarrito($id){
		$this->load->model("M_Tienda","tienda");
		$this->carrito->remove_producto($id);
		
		$contenido=$this->load->view('V_Carrito',Array('carrito'=>$this->carrito) ,true);
		$this->cargaVista(Array('contenido'=>$contenido));
	}


	/*Se encarga de vaciar todo el contenido que existe en el carrito.
	*/
	public function BorraTodoCarrito(){
		$this->load->model("M_Tienda","tienda");
		$this->carrito->Destroy();

		$contenido=$this->load->view('V_Carrito',"" ,true);
		$this->cargaVista(Array('contenido'=>$contenido));
		
	}


	/*Es la funcion encargada de finalizar una compra, almacena todos los productos que se encuentre en el carrito
	* y se envia por correo los detalles del pedido.
	*/


	public function FinalizarCompra(){
		//Estados
		//Cancelado
		//Enviado
		//Recibido
		//Pendiente
			if(isset($_SESSION['idUser'])){

				$this->load->model("M_Tienda","tienda");

				$carro = $this->carrito->get_content();
				$Datos= $this->tienda->Datos_Usuarios($_SESSION['idUser']);
				
				$pedido=array('Estado' =>'P',
							  'Direccion'=>$Datos->Direccion,
							  'CP'=>$Datos->CP,
							  'Provincia'=> $Datos->idProvincia,
							  'idUsuarios'=> $_SESSION['idUser'] );;

				$idPedido=$this->tienda->Insertar_Pedido($pedido);

				
				
				foreach ($carro as $valor) {
					$articulo = array(
						'Precio'=>$valor['precio'],
						'Cantidad'=>$valor['cantidad'],
						'idPedidos'=>$idPedido,
						'idProductos'=>$valor['id']
						);
					$this->tienda->Insertar_Articulos($articulo);
					
				}
				$dfactura=Array('direccion'=>$Datos->Direccion,
					'cp'=>$Datos->CP,
					'Provincia'=>$Datos->idProvincia,
					'idusuario'=>$_SESSION['idUser']);
				$factura=$this->tienda->LineasPedido($idPedido);
				
				
				
				$html=$this->load->view('V_EmailPedido',Array('factura'=>$factura,'idPedido'=>$idPedido,'dfactura'=>$dfactura, 'p_final' => 0),true);
				//echo $html;
				$this->carrito->Destroy();
				$this->Pedidos();
				

				$this->load->library('email');
				
				$this->email->from('aula4@iessansebastian,com', 'Tienda');
				$this->email->to($Datos->Correo);
				
				
				$this->email->subject('Factura Tu tienda online');
				$this->email->message($html);
				
				$this->email->send();
		 	}
		 	else
		 	{
				redirect('Inicio/Loguearse');
			}
	}




	/*Elimina un producto que este añadido en el carrito.
	*@Param idProducto es el identificador del producto que vamos a quitar.
	*/

	public function Quitar($idProducto){

		$this->load->model("M_Tienda","tienda");
		$Producto=$this->tienda->Ver_Producto($idProducto);
		$articulo=[];
		
		
		$articulo = array(
			"id"			=>		$idProducto,
			"cantidad"		=>		1,
			"precio"		=>		$Producto->Precio,
			"nombre"		=>		$Producto->Nombre,
			"descripcion"	=>		$Producto->Descripcion,
			"imagen"		=>		$Producto->Imagen
		);
		

		$this->carrito->remove_items($articulo);
		
		$contenido=$this->load->view('V_Carrito',Array('carrito'=>$this->carrito) ,true);
		$this->cargaVista(Array('contenido'=>$contenido));
	}


	/*-------------------------------------------------------------O--------------------------------------------------------*/



	/*-------------------------------------------------FUNCIONES SOBRE PEDIDOS ------------------------------------------------*/
	
	

	/*carga la vista donde se muestra todos los pedidos del usuario.
	*/
	public function Pedidos(){
		$this->load->model("M_Tienda","tienda");
		$DPedidos=$this->tienda->Ver_Pedidos($_SESSION['idUser']);

		$contenido=$this->load->view('V_Pedidos',Array('ListaP'=>$DPedidos) ,true);
		$this->cargaVista(Array('contenido'=>$contenido));
	}

	/*Pone el estado de un pedido en cancelado.
	*@Param idpedido es el identificador del pedido que se va poner en cancelado.
	*/
	public function Anular_Pedido($idPedido){

		$this->load->model("M_Tienda","tienda");
		
		$this->tienda->Anular_pedido($idPedido);
		
		$this->Pedidos();

	}


	
	/*Es la encargada de visualizar la factura en PDF
	*@Param idpedido es el identificador del pedido.
	*/
	public function Ver_Pdf($idPedido){
		$this->load->model("M_Tienda","tienda");
		$pedido=$this->tienda->Ver_Pedidos($_SESSION['idUser']);
		$nombreP=$this->Nombre_Provincia($pedido[0]['Provincia']);
		$articulos=$this->tienda->Ver_Articulos($idPedido);
		
		
		

		$this->load->library('Pdf');
		// Creación del objeto de la clase heredada
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(10,1,'IDPedidos: '. $pedido[0]['idPedidos'],0,0,'L');
		$pdf->Ln(0);
		$pdf->Cell(10,10,'Direccion: '. $pedido[0]['Direccion'],0,0,'L');
		$pdf->Ln(0);
		$pdf->Cell(10,20,'Codigo Postal: '. $pedido[0]['CP'],0,0,'L');
		$pdf->Ln(0);
		$pdf->Cell(10,30,'Provincia: '.$nombreP->Nombre ,0,0,'');
		$pdf->Ln(0);
		$pdf->Rect(5,27,70,23);
		$pdf->Rect(5,27,70,23);
		//recuadros de productos
		$pdf->Rect(5,55,150,150,'');
		$pdf->Ln(0);
		$pdf->Rect(5,55,30,150);
		$pdf->Rect(35,55,35,150);
		$pdf->Rect(70,55,40,150);
		//recuadros de tabla 

		$pdf->Rect(5,55,150,10);
		$pdf->Rect(5,55,150,10);
		// para el bucle de productos se incrementa 20 en la segunda
		//$pdf->Rect(5,75,150,10);


		$pdf->Cell(15,60,'IDProducto',0,0,'L');
		
		$pdf->Cell(35,60,'Nombre',0,0,'R');
		$pdf->Cell(40,60,'Cantidad',0,0,'R');
		$pdf->Cell(35,60,'Precio',0,0,'R');
		$pdf->Ln(0);
		$contC=80;
		$contR=55;
		
		$precio=0;
		foreach ($articulos as $value) {
					
			$productos=$this->tienda->Ver_Producto($value['idProductos']);
				
		
					$pdf->Cell(20,$contC,$value['idProductos'],0,0,'C');
					$pdf->Cell(45,$contC,$productos->Nombre,0,0,'C');
					$pdf->Cell(30,$contC,$value['Cantidad'],0,0,'C');
					$pdf->Cell(45,$contC,$value['Precio'],0,0,'C');
					$pdf->Ln(0);
					$pdf->Rect(5,$contR,150,10);

				
				$precio=$precio+($value['Cantidad']*$value['Precio']);
				$contC=$contC +20;
				$contR=$contR +20;
		}
		//Casillero de total de precios
		$total=($precio*0.21)+$precio;
		$pdf->Ln(0);
		
		$pdf->Rect(120,230,70,30);
		$pdf->SetXY(122, 232);
		$pdf->SetFont('Times','B',14);
		$pdf->Cell(10,10,'Subtotal: '.$precio,0,2,'L');

		$pdf->SetXY(135, 239);
		
		$pdf->Cell(20,10,'I.V.A: 21%',0,2,'R');
		$pdf->SetXY(135, 246);
		
		$pdf->Cell(26,10,'Total: '.$total,0,2,'R');
		
		$pdf->Output('I','Factura-'.$idPedido);
	}

	/*Muestar los articulos que tiene un pedido.
	*@Param idpedido es el identificador del pedido.
	*/
	public function Ver_ArticulosP($idPedido){
		$this->load->model("M_Tienda","tienda");
		$articulos=$this->tienda->Ver_Articulos($idPedido);

		$contenido=$this->load->view('V_Articulos',Array('Articulos'=>$articulos) ,true);
		$this->cargaVista(Array('contenido'=>$contenido));

	}
	


	/*---------------------------------------------------------------O---------------------------------------------------------------*/


	/*--------------------------------------------------------------FUNCIONES SOBRE USUARIOS-------------------------------------------------*/

	/*Se encarga de habilitar la opcion de poder recupera la contraseña para el usuario.
	*/
	public function Recordar_Contrasena(){
		$this->load->model('M_Tienda','tienda');
		$this->form_validation->set_rules('email', 'Correo', 'required|valid_email|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('V_Recordar');
			
		}
		else
		{
			$Correo=$this->input->post('email');
			$DATOS=$this->tienda->Datos_UserEmail($Correo);
			
			if($DATOS){
				
				$this->load->library('email');
				
				$this->email->from('aula4@iessansebastian,com', 'Tienda');
				$this->email->to($Correo);
				
				
				$this->email->subject('Recuperar Contraseña');
				$this->email->message(base_url()."index.php/Inicio/Cambia_Pass/".$DATOS->idUsuarios."/".sha1($DATOS->Nombre.date("d-m-Y")));
				
				$this->email->send();
				$this->load->view('V_Recordar',array('enviado'=>''));
				
			}
			else
			{	
				
				$this->load->view('V_Recordar',array('enviado'=>''));
			}
		}
	}

	public function Cambia_Pass(){
			$this->load->model('M_Tienda','tienda');
			$id=$this->uri->segment(3);
			$sha=$this->uri->segment(4);
			$DATOS=$this->tienda->Datos_Usuarios($id);
			
			if($sha==sha1($DATOS->Nombre.date("d-m-Y"))){
			
				$this->load->view('V_CambioPass');
			}
			else
			{
				$this->Destacados();
			}

			//$this->load->view('V_CambioPass');

	}
		
		
	/*Carga la pagina para que el usuario pueda cambiar la contraseña y añadir una nueva.
	*/
	public function Cambiar_Pass(){
			$this->load->model("M_Tienda","tienda");
				$id=$this->uri->segment(3);
				$pass=$this->input->post('pass');
				//echo $pass;
				
				$this->tienda->CambiaPass($id,$pass);
				$this->load->view('V_CambioPass',array('cambio'=>''));
				
	}

	

}

 	

 ?>