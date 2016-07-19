<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeria extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Galeria_model', 'galeria');
		$this->load->library('image_lib');
		$this->config->load('app_config');
	}
	
	public function index()
	{	
		$data['galeria'] = $this->galeria->obtener_galerias();
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;

		$data['titulo'] = 'Imágenes';
		
		$data['meta']['titulo'] = 'Imágenes';
		$data['meta']['descripcion'] = 'Álbumes de imágenes del '.$this->config->item('centro_denominacion');
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
		$data['view'] = 'galeria';
		$this->load->view('templates/template', $data);
	}
	
	public function galeria_contenido($alias = false)
	{	
		if (! $alias) {
			show_404();
		}
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;

		$alias = $this->security->xss_clean($alias);
		$data['galeria'] = $this->galeria->obtener_galeria($alias);
		
		if($data['galeria']) {
			
			$data['titulo'] = $data['galeria'][0]->titulo;
			
			$data['meta']['titulo'] = $data['galeria'][0]->titulo;
			$data['meta']['descripcion'] = 'Imágenes del álbum '.$data['galeria'][0]->titulo.' del '.$this->config->item('centro_denominacion');
			$data['meta']['autor'] = $this->config->item('centro_denominacion');
			$data['meta']['url'] = base_url().$this->uri->uri_string();
			$data['meta']['imagen'] = base_url().'img/logo.gif';
			
			$data['view'] = 'galeria_contenido';
			$this->load->view('templates/template', $data);
		}
		else {
			show_404();
		}

	}
	
}

/* End of file galeria.php */
/* Location: ./application/controllers/galeria.php */