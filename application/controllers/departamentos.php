<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Departamentos_model', 'departamentos');
		$this->config->load('app_config');
		
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
		
		$data['meta']['titulo'] = 'Departamentos';
		$data['meta']['descripcion'] = 'Información sobre los Departamentos del '.$this->config->item('centro_denominacion');
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
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
		
		$data['meta']['titulo'] = 'Departamento de '.$data['componentes'][0]->departamento;
		$data['meta']['descripcion'] = 'Información sobre el Departamento de '.$data['componentes'][0]->departamento;
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
		$data['view'] = 'departamento_detalles';
		$this->load->view('templates/template', $data);
	}
	
}

/* End of file departamentos.php */
/* Location: ./application/controllers/departamentos.php */