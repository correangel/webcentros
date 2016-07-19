<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	var $prefs;

	public function __construct() {
		parent::__construct();
		$this->load->model('Noticias_model', 'db_noticias');
		$this->config->load('app_config');

		$prefs = array (
		              'show_next_prev'  => TRUE,
		              'next_prev_url'   => base_url().'index.php/calendario/',
		              'start_day'    => 'monday',
		            );

		$prefs['template'] = '

		   {table_open}<table class="table table-calendar-home text-center">{/table_open}

		   {heading_row_start}<tr>{/heading_row_start}

		   {heading_previous_cell}<th class="text-left"><a href="{previous_url}"><span class="fa fa-chevron-left"></span></a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}" class="text-center">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th class="text-right"><a href="{next_url}"><span class="fa fa-chevron-right"></span></a></th>{/heading_next_cell}

		   {heading_row_end}</tr>{/heading_row_end}

		   {week_row_start}<tr class="days">{/week_row_start}
		   {week_day_cell}<td><strong>{week_day}</strong></td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}

		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td>{/cal_cell_start}

		   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
		   {cal_cell_content_today}<div class="today"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

		   {cal_cell_no_content}{day}{/cal_cell_no_content}
		   {cal_cell_no_content_today}<div class="today">{day}</div>{/cal_cell_no_content_today}

		   {cal_cell_blank}&nbsp;{/cal_cell_blank}

		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}

		   {table_close}</table>{/table_close}
		';

		$this->load->library('calendar', $prefs);
	}

	public function index()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url();
		$config['total_rows'] = $this->db_noticias->total_noticias();
		$config['per_page'] = 10;
    $config['num_links'] = 10;
		$config['uri_segment'] = 1;
		$this->pagination->initialize($config);

		$data['noticias'] = $this->db_noticias->listado_noticias($config['per_page'], $this->uri->segment(1));
		$data['noticias_destacadas'] = $this->db_noticias->listado_noticias_destacadas($config['per_page'], $this->uri->segment(1));

		$data['categorias'] = $this->db_noticias->lista_categorias();

		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
		$data['meta']['titulo'] = $this->config->item('centro_denominacion');
		$data['meta']['descripcion'] = 'Información, noticias y documentos del '.$this->config->item('centro_denominacion');
		$data['meta']['autor'] = $this->config->item('centro_denominacion');
		$data['meta']['url'] = base_url().$this->uri->uri_string();
		$data['meta']['imagen'] = base_url().'img/logo.gif';

		$data['view'] = 'inicio';
		$this->load->view('templates/template', $data);
	}

	public function noticias($categoria, $alias = false)
	{
		$categoria = $this->security->xss_clean($categoria);
		$alias = $this->security->xss_clean($alias);

		if (! $alias) {
			$data['noticias'] = $this->db_noticias->lista_noticias_categoria($alias);

			if (empty($data['noticias'])) {
				show_404();
			}

			$data['template']['top'] = 0;
			$data['template']['bottom'] = 1;

			$data['titulo'] = $categoria;
			
			$data['meta']['titulo'] = $categoria;
			$data['meta']['descripcion'] = 'Noticias de la categoría '.$categoria;
			$data['meta']['autor'] = $this->config->item('centro_denominacion');
			$data['meta']['url'] = base_url().$this->uri->uri_string();
			$data['meta']['imagen'] = base_url().'img/logo.gif';
			
			$data['view'] = 'noticias_categoria';
			$this->load->view('templates/template', $data);
		}
		else {
			$data['noticia'] = $this->db_noticias->obtener_noticia($categoria, $alias);

			if (empty($data['noticia'])) {
				show_404();
			}

			$this->db_noticias->ver_noticia($categoria, $alias);

			$data['template']['top'] = 0;
			$data['template']['bottom'] = 1;

			$data['titulo'] = $data['noticia']->titulo;
			
			$data['meta']['titulo'] = $data['noticia']->titulo;
			$data['meta']['descripcion'] = trim(substr($data['noticia']->contenido,0, 200));
			$data['meta']['autor'] = $data['noticia']->autor;
			$data['meta']['url'] = base_url().$this->uri->uri_string();
			
			if (! $data['noticia']->imagen_cab) {
				$data['meta']['imagen'] = base_url().'img/logo.gif';
			}
			else {
				$data['meta']['imagen'] = $data['noticia']->imagen_cab;
			}
			
			$data['view'] = 'noticias';
			$this->load->view('templates/template', $data);
		}
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */
