<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

	public function getProductos(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getProducto($id){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}
	public function getProductosA($id){

		$this->db->select("p.codigo,p.nombre,pa.*");
		$this->db->from("productos_asociados pa");
		$this->db->join("productos p", "pa.producto_asociado = p.id");
		$this->db->where("pa.producto_id",$id);
		$resultado = $this->db->get();

		return $resultado->result();
	}
	public function save($data){
		if ($this->db->insert("productos",$data)) {
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	public function saveAsociados($data){
		return $this->db->insert("productos_asociados",$data);
			
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("productos",$data);
	}

	public function deleteProductosAsociados($idproducto){
		$this->db->where("producto_id",$idproducto);
		return $this->db->delete("productos_asociados");
	}

}