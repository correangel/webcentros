<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	var $prefs;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Noticias_model', 'db_noticias');
		$this->load->library('rssparser');
		
		$prefs = array (
		              'show_next_prev'  => TRUE,
		              'next_prev_url'   => base_url().'index.php/calendar/',
		              'start_day'    => 'monday',
		            );
		            
		$prefs['template'] = '
		
		   {table_open}<table class="table table-calendar-home text-center">{/table_open}
		
		   {heading_row_start}<tr>{/heading_row_start}
		
		   {heading_previous_cell}<th class="text-left"><a href="{previous_url}"><span class="fa fa-chevron-left"></span></a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}" class="text-center">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th class="text-right"><a href="{next_url}"><span class="fa fa-chevron-right"></span></a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
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
		$this->rssparser->set_feed_url('http://www.juntadeandalucia.es/educacion/www/novedades.xml');
		$this->rssparser->set_cache_life(30);
		$data['rss'] = $this->rssparser->getFeed(5);
		
		
		$this->db->order_by('fechapub','desc');
		$data['noticias'] = $this->db_noticias->lista_noticias(10);
		$data['noticias_destacadas'] = $this->db_noticias->lista_noticias(10, true);
		
		$data['categorias'] = $this->db_noticias->lista_categorias();
		
		$data['template']['top'] = 0;
		$data['template']['bottom'] = 1;
		
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
			$data['view'] = 'noticias';
			$this->load->view('templates/template', $data);
		}
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */