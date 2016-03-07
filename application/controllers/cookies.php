<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cookies extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{	
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Uso de cookies';
		$data['view'] = 'cookies';
		$this->load->view('templates/template', $data);
	}
}

/* End of file cookies.php */
/* Location: ./application/controllers/cookies.php */