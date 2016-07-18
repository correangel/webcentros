<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Calendario_model extends CI_Model {
	
	function obtener_festivos() {
		
		$this->db->order_by('fecha', 'asc');
		$consulta = $this->db->get('festivos');
		return $consulta->result();
		
	}
	
	function obtener_numero_actividades_extraescolares() {
		
		$this->db->select('MONTH(fechaini) AS num_mes, COUNT(*) AS num_actividades');
		$this->db->where('fechaini BETWEEN \'2015-09-15\' AND \'2016-06-23\'');
		$this->db->where('categoria', '2');
		$this->db->where('confirmado', '1');
		$this->db->group_by('MONTH(fechaini)');
		$this->db->order_by('fechaini', 'DESC');
		$consulta = $this->db->get('calendario');
		return $consulta->result();
		
	}
	
	function obtener_actividades_extraescolares($month = false) {
		
		if (is_numeric($month) && ($month >= 1 && $month <= 12)) {
			$this->db->where('MONTH(fechaini)', $month);
		}
		$this->db->where('fechaini BETWEEN \'2015-09-15\' AND \'2016-06-23\'');
		$this->db->where('categoria', '2');
		$this->db->where('confirmado', '1');
		$this->db->order_by('fechaini', 'desc');
		$this->db->order_by('horaini', 'asc');
		$consulta = $this->db->get('calendario');
		return $consulta->result();
		
	}
	
}

/* End of file calendario_model.php */
/* Location: ./application/models/calendario_model.php */