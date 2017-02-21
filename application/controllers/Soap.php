<?php  
	class Soap extends CI_Controller {

		public function Geolocalizacion(){

			// Create a new soap client 
			$client = new SoapClient('http://ws.cdyne.com/ip2geo/ip2geo.asmx?wsdl');
			 
			$param = array(
			 'ipAddress' => $this->input->ip_address(),
			 'licenseKey' => 0,
			);
			 
			$result = $client->ResolveIP($param);
			 echo "Ciudad: ". $result->ResolveIPResult->City;
			 echo "Pais: ". $result->ResolveIPResult->Country;
			// View the response from CDYNE
			//print_r ($result);

		}



}






?>