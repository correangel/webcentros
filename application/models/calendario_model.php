<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Calendario_model extends CI_Model {
	
	function obtener_calendario() {
		
		$this->db->order_by('fecha', 'asc');
		$consulta = $this->db->get('calendario');
		return $consulta->result();
		
	}
	
	
	
}

/* End of file calendario_model.php */
/* Location: ./application/models/calendario_model.php */