<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros_texto extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Libros_texto_model', 'libros_texto');
	}
	
	public function index()
	{	
		$data['libros'] = array();
		
		$niveles = $this->libros_texto->obtener_niveles();
		
		foreach ($niveles as $item) {
			$libros = $this->libros_texto->obtener_libros_nivel($item->nivel);
			
			$libros_nivel = array(
				array(
					'nivel' => $item->nivel,
					'libros' => $libros,
				)
			);
			
			$data['libros'] = array_merge($data['libros'], $libros_nivel);
			
		}
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Libros de texto';
		$data['view'] = 'libros_texto';
		$this->load->view('templates/template', $data);
	}
}

/* End of file libros_texto.php */
/* Location: ./application/controllers/libros_texto.php */