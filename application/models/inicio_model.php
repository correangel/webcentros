<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Inicio_model extends CI_Model {
	
	function lista_usuarios() {
		
		$consulta = $this->db->get('usuarios');
		return $consulta->result();
		
	}
	
	function detalles_usuario($id_usuario) {
		
		$this->db->where('id', $id_usuario);
		$consulta = $this->db->get('usuarios');
		return $consulta->row();
		
	}
	
}

/* End of file inicio_model.php */
/* Location: ./application/models/inicio_model.php */