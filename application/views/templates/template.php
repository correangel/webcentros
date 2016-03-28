<?php
// Global Configs
$this->config->load('app_config');

// Global Libraries
$this->load->library('user_agent');

$CI =& get_instance();
$this->load->model('menu_model', 'db_menu');
$this->load->model('noticias_model', 'db_noticias');
$menu['menu_superior'] = $CI->db_menu->obtener_menu('menu_superior');
$bottom['noticias_mas_leidas'] = $CI->db_noticias->noticias_mas_leidas();

// Template Views
$this->load->view('templates/frontend/header', $menu);


if ((! empty($this->uri->segment(1))) && ($this->uri->segment(1) != 'noticias') && ! is_numeric($this->uri->segment(1))) {
	$this->load->view('templates/frontend/breadcrumbs');
}

if (isset($template['top']) && $template['top'] == 1) {
	$this->load->view('templates/frontend/top');
}

$this->load->view('frontend/' . $view);

if (isset($template['bottom']) && $template['bottom'] == 1) {
	$this->load->view('templates/frontend/bottom', $bottom);
}

$this->load->view('templates/frontend/footer');

/* End of file template.php */
/* Location: ./views/templates/frontend/template.php */
