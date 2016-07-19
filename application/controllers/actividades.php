<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Calendario_model', 'calendario');
		$this->config->load('app_config');
	}
	
	public function index()
	{	
		$data['meses_actividades'] = $this->calendario->obtener_numero_actividades_extraescolares();
		
		$data['anio_curso'] = substr($this->config->item('curso_actual'), 0, 4);
		
		foreach ($data['meses_actividades'] as $mes) {
			$data['activ'.$mes->num_mes] = $this->calendario->obtener_actividades_extraescolares($mes->num_mes);
		}
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		
		
		$data['titulo'] = 'Actividades extraescolares';
		
		$data['meta']['titulo'] = $data['titulo'];
		$data['meta']['descripcion'] = 'Actividades Complementarias y Extraescolares programadas para el curso escolar '.$this->config->item('curso_actual');
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
		$data['view'] = 'actividades';
		$this->load->view('templates/template', $data);
	}
}

/* End of file actividades.php */
/* Location: ./application/controllers/actividades.php */