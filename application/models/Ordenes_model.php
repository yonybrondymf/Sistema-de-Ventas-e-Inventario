<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_model extends CI_Model {

	public function getOrdenes(){
		$this->db->where("fecha", date("Y-m-d"));
		$this->db->where("estado","1");
		$resultados = $this->db->get("pedidos");


		$return = array();

	    foreach ($resultados->result() as $pedido)
	    {
	        $return[$pedido->id] = $pedido;
	        $return[$pedido->id]->mesas = $this->getPedidosMesas($pedido->id); // Get the categories sub categories
	    }

	    return $return;
	}

	public function getPedidosMesas($pedido_id)
	{	
		$this->db->select("m.id,m.numero");
		$this->db->from("pedidos_mesa pm");
		$this->db->join("mesas m", "pm.mesa_id = m.id");
	    $this->db->where('pm.pedido_id', $pedido_id);
	    $query = $this->db->get();
	    return $query->result();
	}

	public function getPedido($pedido_id)
	{	
		
	    $this->db->where('id', $pedido_id);
	    $query = $this->db->get("pedidos");
	    return $query->row();
	}

	public function getProductosByCategoria($categoria){
		$this->db->where("categoria_id",$categoria);
		$this->db->where("estado","1");
		$resultados = $this->db->get("productos");
		return $resultados->result();
	}

	public function save($data){
		if ($this->db->insert("pedidos",$data)) {
			return $this->db->insert_id();
		}
		return false;
	}
	public function getCategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("pedidos");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("pedidos",$data);
	}

	public function updateMesa($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("mesas",$data);
	}

	public function savePedidoMesa($data){
		return $this->db->insert("pedidos_mesa",$data);
	}

	public function savePedidoProductos($data){
		return $this->db->insert("pedidos_productos",$data);
	}

	public function getPedidosProductos($id){
		$this->db->select("p.id as idprod,p.nombre,p.stock,p.condicion,p.precio,pp.*");
		$this->db->from("pedidos_productos pp");
		$this->db->join("productos p", "pp.producto_id=p.id");

		$this->db->where("pp.pedido_id",$id);
		$this->db->order_by("pp.estado");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function deletePedidoProductos($pedido_id){
		$this->db->where("pedido_id",$pedido_id);
		return $this->db->delete("pedidos_productos");
	}

	public function comprobantePredeterminado(){
		$this->db->where("predeterminado",1);
		$resultado = $this->db->get("tipo_comprobante");
		return $resultado->row();
	}

	public function updatePedidoProductos($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("pedidos_productos",$data);
	}

}
