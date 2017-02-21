
<?php  
class Smitienda extends CI_Model
{
	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function Total(){
		return $this->db->count_all('productos');

	}

	public function Lista($offset, $limit){

		$offset=(int)$offset;
        $limit=(int) $limit;
        
        $listaProductosDevolver=array();


		$query="Select * From productos LIMIT $offset,  $limit ";
		$productos=$this->db->query($query);
		
		

    	foreach ($productos->result() as $valor) {
    	       
                  
            $listaProductosDevolver[]=array(
                'nombre'=>(string) $valor->Nombre, 
                'descripcion'=>(string) $valor->Descripcion, 
                'precio'=>(string) $valor->Precio,
                'img'=>base_url('assets/img/'.$valor->Imagen.'.jpg'),
                'url'=>base_url('index.php/Inicio/Ver_Producto/'.$valor->idProductos)
            );            
        }


        return $listaProductosDevolver; 



	}
}




?>	