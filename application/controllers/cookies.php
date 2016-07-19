<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cookies extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('app_config');
	}
	
	public function index()
	{	
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Uso de cookies';
		
		$data['meta']['titulo'] = 'Uso de cookies';
		$data['meta']['descripcion'] = 'Información sobre el uso de cookies en nuestra web '.base_url();
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
		$data['view'] = 'cookies';
		$this->load->view('templates/template', $data);
	}
}

/* End of file cookies.php */
/* Location: ./application/controllers/cookies.php */