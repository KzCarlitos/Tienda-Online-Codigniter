<?php 
class XML extends CI_Controller {
    
    /**
     * Exportación de XML
     */
    public function export() {
        $this->load->model('M_Tienda','tienda');
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="DatosCatPro.xml"');
        
        $xml=new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0','UTF-8');
        $xml->startElement('Categorias');
        $categoria = $this->tienda->Categoria();
        foreach ($categoria as $cat) {
            $xml->startElement($cat->Nombre);
            $productos=$this->tienda->Ver_Categoria($cat->idCategoria);
            foreach ($productos as $pro) {
                     $xml->startElement('producto');
                        $xml->startElement('idProducto');
                         $xml->text($pro->idProductos);
                        $xml->endElement();

                        $xml->startElement('Nombre');
                         $xml->text($pro->Nombre);
                        $xml->endElement();

                        $xml->startElement('Precio');
                         $xml->text($pro->Precio);
                        $xml->endElement();

                        $xml->startElement('Imagen');
                         $xml->text($pro->Imagen);
                        $xml->endElement();

                     $xml->endElement();
                }    




            $xml->endElement();
           
        }
        
        $xml->endElement();
         
        $xml->endDocument();
        $Datos = $xml->outputMemory();
        echo $Datos;
    
    }


    public function import() {
        $this->load->view("V_ImXml.php");
    }


     public function Carga_Import() {
        $this->load->model('M_Tienda','tienda');
        $archivo = $_FILES['xml']['name'];
       
        
        $xml = simplexml_load_file($archivo);
        
        foreach ($xml->producto as $item) {
                $datos = array(
                    "Nombre" => $item->Nombre,
                    "Precio" => $item->Precio,
                    "Imagen" => $item->Imagen,
                    "IVA" => $item->Iva,
                    "Descripcion" => $item->Descripcion,
                    "Stock" => $item->Stock,
                    "Oculto" => $item->Oculto,
                    "Destacado" => $item->Destacado,
                    "idCategoria" => $item->idCategoria

                );
                $this->tienda->Insertar_Productos($datos);
         }
    
    echo "Importado con éxito";

    
}



}
?>