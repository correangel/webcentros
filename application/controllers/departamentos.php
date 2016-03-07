<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Departamentos_model', 'departamentos');
		
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
		$data['departamentos'] = $this->departamentos->obtener_departamentos();
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Departamentos';
		$data['view'] = 'departamentos';
		
		$this->load->view('templates/template', $data);
	}
	
	public function departamento_detalles($alias_depto)
	{	
		$data['alias'] = $alias_depto;
		$data['componentes'] = $this->departamentos->obtener_profesores_depto($data['alias']);
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Departamento de '.$data['componentes'][0]->departamento;
		$data['view'] = 'departamento_detalles';
		
		$this->load->view('templates/template', $data);
	}
	
}

/* End of file departamentos.php */
/* Location: ./application/controllers/departamentos.php */