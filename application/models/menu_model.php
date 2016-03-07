<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menu_model extends CI_Model {
	
	function obtener_menu($menu_nombre) {
		
		$this->db->select('*');
		$this->db->from('menu_items');
		$this->db->join('menu_tipos', 'menu_items.id_tipomenu = menu_tipos.id');
		$this->db->where('menu_tipos.nombre', $menu_nombre);
		$consulta = $this->db->get();
		return $consulta->result();
		
	}
	
	
	
}

/* End of file estudios_model.php */
/* Location: ./application/models/estudios_model.php */