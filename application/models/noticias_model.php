<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Noticias_model extends CI_Model {

	function total_noticias()
	{
		$this->db->where('fechapub <= NOW()');
		$query = $this->db->get('noticias');
		return $query->num_rows();
	}

	function listado_noticias($limit = 10, $pagina = 0)
	{
		if ($pagina > 0) {
			$offset = $pagina + $limit - 1;
		}
		else {
			$offset = 0;
		}

		$this->db->select('noticias.*, noticias_categorias.alias AS alias_categoria, noticias_categorias.nombre AS nombre_categoria');
		$this->db->join('noticias_categorias', 'noticias.id_categoria = noticias_categorias.id');
		$this->db->where('noticias.fechapub <= NOW()');
		$this->db->order_by('fechapub','desc');
		$query = $this->db->get('noticias', $limit, $offset);

		return $query->result();
	}

	function listado_noticias_destacadas($limit = 10, $offset = 0)
	{
		$this->db->select('noticias.*, noticias_categorias.alias AS alias_categoria, noticias_categorias.nombre AS nombre_categoria');
		$this->db->join('noticias_categorias', 'noticias.id_categoria = noticias_categorias.id');
		$this->db->where('noticias.fechapub <= NOW()');
		$this->db->order_by('fechapub','desc');
		$this->db->where('noticias.fechafinpub > NOW()');
		$query = $this->db->get('noticias', $limit, $offset);

		return $query->result();
	}

	function lista_categorias()
	{
		$consulta = $this->db->get('noticias_categorias');
		return $consulta->result();
	}

	function lista_noticias_categoria($alias_categoria)
	{
		$this->db->select('noticias.*, noticias_categorias.alias AS alias_categoria, noticias_categorias.nombre AS nombre_categoria');
		$this->db->from('noticias');
		$this->db->join('noticias_categorias', 'noticias.id_categoria = noticias_categorias.id');
		$this->db->where('noticias_categorias.alias', 'direccion-del-centro');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	function obtener_noticia($categoria, $alias)
	{
		$this->db->select('noticias.*, noticias_categorias.alias AS alias_categoria, noticias_categorias.nombre AS nombre_categoria');
		$this->db->from('noticias');
		$this->db->join('noticias_categorias', 'noticias.id_categoria = noticias_categorias.id');
		$this->db->where('noticias_categorias.alias', $categoria);
		$this->db->where('noticias.alias', $alias);
		$consulta = $this->db->get();
		return $consulta->row();
	}

	function ver_noticia($categoria, $alias)
	{
		$noticia = $this->obtener_noticia($categoria, $alias);
		$vistas = $noticia->vistas+1;

		$data = array(
		               'vistas' => $vistas,
		            );

		$this->db->where('alias', $alias);
		return $this->db->update('noticias', $data);
	}

	function noticias_mas_leidas()
	{
		$this->db->select('id, titulo, alias, vistas');
		$this->db->from('noticias');
		$this->db->group_by('vistas');
		$this->db->order_by('vistas', 'desc');
		$this->db->limit(5);
		$consulta = $this->db->get();
		return $consulta->result();
	}



}

/* End of file noticias_model.php */
/* Location: ./application/models/noticias_model.php */
