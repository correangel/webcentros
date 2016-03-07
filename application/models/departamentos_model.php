<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Departamentos_model extends CI_Model {
	
	function obtener_departamentos() {
		
		$this->db->distinct();
		$this->db->select('departamento, alias');
		$this->db->where('departamento !=', 'Admin');
		$this->db->where('departamento !=', 'Administracion');
		$this->db->where('departamento !=', 'Conserjeria');
		$this->db->order_by('departamento', 'asc');
		$consulta = $this->db->get('departamentos');
		return $consulta->result();
		
	}
	
	function obtener_profesores_depto($depto = false) {
		
		if($depto == false) show_404();
		$this->db->where('alias', $depto);
		$this->db->order_by('profesor', 'asc');
		$consulta = $this->db->get('departamentos');
		return $consulta->result();
		
	}
	
}

/* End of file departamentos_model.php */
/* Location: ./application/models/departamentos_model.php */