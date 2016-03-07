<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenido extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Contenido_model', 'contenido');
	}
	
	public function index($alias = false)
	{	
		if (! $alias) {
			show_404();
		}
		
		$alias = $this->security->xss_clean($alias);
		$data['contenido'] = $this->contenido->obtener_contenido($alias);
		
		if($data['contenido']) {
			$data['template']['top'] = 0;
			$data['template']['bottom'] = 1;
			
			$data['titulo'] = $data['contenido']->titulo;
			$data['view'] = 'contenido';
			
			$this->load->view('templates/template', $data);
		}
		else {
			show_404();
		}
	}
	
}

/* End of file contenido.php */
/* Location: ./application/controllers/contenido.php */