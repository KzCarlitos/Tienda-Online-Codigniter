<?php 



    class Excel extends CI_Controller {
        
        /**
         * Exporta los datos de los artículos en excel
        */
        public function export() {
        
            $this->load->model('M_Tienda','tienda');
            $categorias=$this->tienda->Categoria();
            
          

				/** Include PHPExcel */
				require_once APPPATH."/third_party/PHPExcel.php"; 

				// Create new PHPExcel object

				$objPHPExcel = new PHPExcel();

				// Set document properties

				$objPHPExcel->getProperties()->setCreator("Admin")
											 ->setLastModifiedBy("Admin")
											 ->setTitle("Categoria")
											 ->setSubject("Categoria")
											 ->setDescription("Datos Categoria")
											 ->setKeywords("Categoria")
											 ->setCategory("Categoria");


				// Add some data

				$objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A1', 'IDCategoria')
				            ->setCellValue('B1', 'Nombre')
				            ->setCellValue('C1', 'Descripcion')
				            ->setCellValue('D1', 'Anuncio')
				            ->setCellValue('E1', 'Oculto');
				 $cel=2;
				 foreach ($categorias as $cat) {

				 	$objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$cel, $cat->idCategoria)
				            ->setCellValue('B'.$cel, $cat->Nombre)
				            ->setCellValue('C'.$cel, $cat->Descripcion)
				            ->setCellValue('D'.$cel, $cat->Anuncio)
				            ->setCellValue('E'.$cel, $cat->Oculto);
				            $cel=$cel+1;
				 }

				// Rename worksheet

				$objPHPExcel->getActiveSheet()->setTitle('Categoria');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Save Excel 2007 file

				$filename='categoria.xls';
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save($filename);

				header('Content-type: application/vnd.ms-excel');//esta es la principal
				header("Content-Disposition: attachment; filename='".$filename);
				readfile($filename);
				
				exit;

        }



        public function import(){
        	$this->load->view('V_ImExcel');
        }


         public function Cargar_Excel() {
            $this->load->model('M_Tienda','tienda');
            $archivo = $_FILES['excel']['tmp_name'];
            move_uploaded_file($archivo, APPPATH.'excel/' . $_FILES['excel']['name']);
            $direccion=APPPATH.'excel/'.$_FILES['excel']['name'];
            
            require_once APPPATH."third_party/PHPExcel/IOFactory.php"; 
            //require_once 'application/libraries/PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load($direccion);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow();
                $highestColumn      = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $numeroColumnas = ord($highestColumn) - 64;
                for ($row = 2; $row <= $highestRow; ++ $row) {
                    $data = array(
                                
                                "Nombre" => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                                "Precio" => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                                "Descuento" => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
                                "Imagen" => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                                "IVA" => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                                "Descripcion" => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                                "Anuncio" => $worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                                "Oculto" => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                                "idCategoria" => $worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                                "Stock" => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                                "Destacado" => $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                            );
                            $this->tienda->Insertar_Productos($data);
                }
            }
            
            echo "Importado con éxito";
        }




}







 ?>