<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Galeria_model extends CI_Model {
	
	function obtener_galerias() {
		
		$this->db->select('galeria.id, galeria.titulo, galeria.alias, galeria.descripcion, galeria.fechapub,(SELECT COUNT(*) FROM galeria_contenido WHERE id_galeria= galeria.id ) AS numfotos, (SELECT imagen FROM galeria_contenido WHERE id_galeria = galeria.id ORDER BY galeria_contenido.fechapub ASC LIMIT 1) AS imagen');
		$this->db->from('galeria');
		$this->db->order_by('galeria.fechapub', 'desc');
		$consulta = $this->db->get();
		return $consulta->result();
		
	}
	
	function obtener_galeria($alias) {
		
		$this->db->select('galeria.titulo, galeria_contenido.*');
		$this->db->from('galeria');
		$this->db->join('galeria_contenido', 'galeria.id = galeria_contenido.id_galeria');
		$this->db->where('galeria.alias', $alias);
		$consulta = $this->db->get();
		return $consulta->result();
		
	}
	
}

/* End of file galeria_model.php */
/* Location: ./application/models/galeria_model.php */