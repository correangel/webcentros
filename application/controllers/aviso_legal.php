<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aviso_legal extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{	
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Aviso legal';
		$data['view'] = 'aviso_legal';
		$this->load->view('templates/template', $data);
	}
}

/* End of file aviso_legal.php */
/* Location: ./application/controllers/aviso_legal.php */