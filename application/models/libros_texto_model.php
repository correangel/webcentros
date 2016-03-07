<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Libros_texto_model extends CI_Model {
	
	function obtener_niveles() {
		
		$this->db->distinct();
		$this->db->select('nivel');
		$this->db->order_by('nivel', 'ASC');
		$consulta = $this->db->get('textos');
		return $consulta->result();
		
	}
	
	function obtener_libros_nivel($nivel) {
		
		$nivel = trim($nivel);
		
		$this->db->where('nivel', $nivel);
		$this->db->order_by('asignatura', 'ASC');
		$consulta = $this->db->get('textos');
		return $consulta->result();
		
	}
	
	
	
}

/* End of file libros_texto_model.php */
/* Location: ./application/models/libros_texto_model.php */