<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Biblioteca_model extends CI_Model {
	
	function obtener_fecha_actualizacion() {
		
		$query = $this->db->query("SHOW TABLE STATUS LIKE 'biblioteca'");
		$row = $query->result();
		
		return array('rows' => $row[0]->Rows, 'update_time' => $row[0]->Update_time);
	}
	
	function obtener_listado_libros($autor = false, $titulo = false, $editorial = false, $isbn = false) {
		
		
		$this->db->select('Autor, Titulo, Editorial, ISBN, extension, anoEdicion, lugarEdicion, ubicacion, COUNT(*) AS ejemplares');
		
		if (! empty($autor)) {
			$this->db->like('Autor', $autor);
		}
		
		if (! empty($titulo)) {
			$this->db->like('Titulo', $titulo);
		}
		
		if (! empty($editorial)) {
			$this->db->like('Editorial', $editorial);
		}
		
		if (! empty($isbn)) {
			$this->db->like('ISBN', $isbn);
		}
		
		$this->db->group_by('ISBN');
		$this->db->order_by('Titulo', 'ASC');
		$query = $this->db->get('biblioteca');
		return $query->result();
		
	}

	
}

/* End of file biblioteca_model.php */
/* Location: ./application/models/biblioteca_model.php */