<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipo_directivo extends CI_Controller {

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
		
		$default = "localhost";
		$size = 100;
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Equipo directivo';
		$data['view'] = 'equipo_directivo';
		
		$data['equipo_directivo'] = array(
			array(
			 	'cargo' => 'Director/a',
			 	'imagen' => '',
				'nombre' => 'Francisco Javier Márquez',
				'telefono' => '951270721',
				'correo-e' => 'director@iesmonterroso.org',
			),
			array(
				'cargo' => 'Vicedirector/a',
				'imagen' => '',
				'nombre' => 'Francisco Pérez Gomar',
				'telefono' => '671534066',
				'correo-e' => 'vicedirector@iesmonterroso.org',
			),
			array(
				'cargo' => 'Secretario/a',
				'imagen' => '',
				'nombre' => 'Lourdes Barrutia',
				'telefono' => '671534068',
				'correo-e' => 'instituto@iesmonterroso.org',
			),
			array(
				'cargo' => 'Jefe/a de estudios',
				'imagen' => '',
				'nombre' => 'Juan Serrano Pérez',
				'telefono' => '671534069',
				'correo-e' => 'jefatura@iesmonterroso.org',
			),
			array(
				'cargo' => 'Jefe/a de estudios adjunto/a',
				'imagen' => '',
				'nombre' => 'Miguel Ángel García González',
				'telefono' => '671534069',
				'correo-e' => 'jefatura@iesmonterroso.org',
			)
		);
		
		$this->load->view('templates/template', $data);
	}
	
}

/* End of file equipo_directivo.php */
/* Location: ./application/controllers/equipo_directivo.php */