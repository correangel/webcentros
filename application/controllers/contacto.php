<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		function telefono($telefono) {
			
			$telefono = trim($telefono);
			$telefono_1 = substr($telefono, 0, 3);
			$telefono_2 = substr($telefono, 3, 2);
			$telefono_3 = substr($telefono, 5, 2);
			$telefono_4 = substr($telefono, 7, 2);
			$telefono = $telefono_1 . ' ' . $telefono_2  . ' ' . $telefono_3  . ' ' . $telefono_4;
			
			return $telefono;
		}
	}
	
	public function index()
	{	
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Contacto';
		$data['view'] = 'contacto';
		$this->load->view('templates/template', $data);
	}
}

/* End of file contacto.php */
/* Location: ./application/controllers/contacto.php */