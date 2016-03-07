<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contenido_model extends CI_Model {
	
	function obtener_contenido($alias) {
		
		$this->db->select('*');
		$this->db->from('contenido');
		$this->db->where('alias', $alias);
		$consulta = $this->db->get();
		return $consulta->row();
		
	}
	
	
	
}

/* End of file contenido_model.php */
/* Location: ./application/models/contenido_model.php */