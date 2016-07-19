<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Calendario_model', 'calendario');
		$this->config->load('app_config');
		
		$prefs = array (
		               'start_day'    => 'monday',
		               'month_type'   => 'long',
		               'day_type'     => 'short'
		             );
		             
		$prefs['template'] = '
		
		   {table_open}<table class="table table-calendar table-condensed table-bordered text-center">{/table_open}
		
		   {heading_row_start}<tr style="background-color: #dd4814; color: #fff;">{/heading_row_start}
		
		   {heading_previous_cell}<th class="text-left"><a href="{previous_url}"><span class="fa fa-chevron-left"></span></a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}" class="text-center" style="font-size: 1.2em;">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th class="text-right"><a href="{next_url}"><span class="fa fa-chevron-right"></span></a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td><strong>{week_day}</strong></td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		
		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td>{/cal_cell_start}
		
		   {cal_cell_content}<div class="label label-danger">{day}</div>{/cal_cell_content}
		   {cal_cell_content_today}<div class="label label-danger">{day}</div>{/cal_cell_content_today}
		
		   {cal_cell_no_content}{day}{/cal_cell_no_content}
		   {cal_cell_no_content_today}<div>{day}</div>{/cal_cell_no_content_today}
		
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		
		   {table_close}</table>{/table_close}
		';
		
		$this->load->library('calendar', $prefs);
	}
	
	public function index()
	{	
		$calendario = $this->calendario->obtener_festivos();
		
		foreach ($calendario as $item_calendario) {
			
			$cal_fecha = explode('-', $item_calendario->fecha);
			$anio = $cal_fecha[0];
			$mes = $cal_fecha[1];
			$dia = $cal_fecha[2];
			
			if($mes < 10) $mes = ltrim($mes, '0');
			if($dia < 10) $dia = ltrim($dia, '0');
			
			$data['cal_'.$anio.'_'.$mes][$dia] = $item_calendario->nombre;
		}
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['titulo'] = 'Calendario escolar <small>Curso '.$this->config->item('curso_actual').'</small>';
		
		$data['meta']['titulo'] = $data['titulo'];
		$data['meta']['descripcion'] = 'Calendario del curso escolar '.$this->config->item('curso_actual');
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';
		
		$data['view'] = 'calendario';
		$this->load->view('templates/template', $data);
	}
	
}

/* End of file calendario.php */
/* Location: ./application/controllers/calendario.php */