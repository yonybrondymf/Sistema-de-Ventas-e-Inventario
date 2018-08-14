<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		//$this->permisos = $this->backend_lib->control();
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Categorias_model");
		$this->load->model("Mesas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'ordenes' => $this->Ordenes_model->getOrdenes(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){
		$data  = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(1), 

		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$mesas = $this->input->post("mesas");
		$productos = $this->input->post("productos");
		$cantidades = $this->input->post("cantidades");

		$dataPedido = array(
			"fecha" => date("Y-m-d"),
			"usuario_id" => $this->session->userdata("id"),
			"estado" => 1
		);

		$pedido_id = $this->Ordenes_model->save($dataPedido);

		if ($pedido_id != false) {
			for($i = 0; $i < count($mesas);$i++){
				$dataMesas = array(
					"estado" => 0
				);
				$dataPedidoMesas = array(
					"pedido_id" => $pedido_id,
					"mesa_id" => $mesas[$i],
				);
				$this->Ordenes_model->updateMesa($mesas[$i],$dataMesas);
				$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			}

			for ($i=0; $i < count($productos) ; $i++) { 
				$dataPedidoProductos = array(
					"pedido_id" => $pedido_id,
					"producto_id" => $productos[$i],
					"cantidad" => $cantidades[$i]
				);

				$this->Ordenes_model->savePedidoProductos($dataPedidoProductos);

				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->condicion == "1") {
					$this->updateProducto($productos[$i],$cantidades[$i]);
					$productoActual = $this->Productos_model->getProducto($productos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $productos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
				}
				$this->updateProductosAsociados($productos[$i]);
			}
			redirect(base_url()."movimientos/ordenes");
		}else{
			redirect(base_url()."movimientos/ordenes/add");
		}
		
	}

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getProducto($idproducto);
		$data = array(
			'stock' => $productoActual->stock - $cantidad, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	protected function updateProductosAsociados($idproducto){
		$productosA = $this->Productos_model->getProductosA($idproducto);
		if (!empty($productosA)) {
			foreach ($productosA as $productoA) {
				$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

				if ($productoActual->condicion != 0) {
					$this->updateProducto($productoA->producto_asociado,$productoA->cantidad);
				}
				
			}
		}
	}

	public function edit($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id), 
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(), 
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			'pedidomesas' => $this->Ordenes_model->getPedidosMesas($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idPedido = $this->input->post("idPedido");
		$cantidades = $this->input->post("cantidades");
		$productos = $this->input->post("productos");
		$mesa = $this->input->post("mesa");

		$detalles = $this->Ordenes_model->getPedidosProductos($idPedido);
        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->idprod);

            $productosAsociados = $this->Productos_model->getProductosA($detalle->idprod);

        	foreach ($productosAsociados as $productoA) {
        		$infoproductoA = $this->Productos_model->getProducto($productoA->producto_asociado);

        		$dataProductoA = array(
                    'stock' => $infoproductoA->stock + $productoA->cantidad, 
                );

                $this->Productos_model->update($productoA->producto_asociado,$dataProductoA);

        	}



            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            if ($infoproducto->condicion == "1") {
            	$this->Productos_model->update($detalle->idprod,$dataProducto);

            }

        }

		//eliminar productos
		$this->Ordenes_model->deletePedidoProductos($idPedido);

		//agregar mesas al pedido
		$dataPedidoMesas = array(
			'pedido_id' => $idPedido,
			'mesa_id' => $mesa 
		);
		if ($this->Ordenes_model->savePedidoMesa($dataPedidoMesas)) {
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($mesa,$dataMesas);

			for ($i=0; $i < count($productos) ; $i++) { 
				$infoproducto = $this->Productos_model->getProducto($productos[$i]);

                $dataProducto = array(
                    'stock' => $infoproducto->stock - $cantidades[$i], 
                );

                if ($infoproducto->condicion == "1") {
                	$this->Productos_model->update($productos[$i],$dataProducto);
                	$productoActual = $this->Productos_model->getProducto($productos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $productos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
	            }


                $dataDetalle  = array(
                    'pedido_id'     => $idPedido, 
                    'producto_id'     => $productos[$i],
                    'cantidad' => $cantidades[$i],
                    'estado' => 0
                );

                $this->Ordenes_model->savePedidoProductos($dataDetalle);
                $this->updateProductosAsociados($productos[$i]);

			}

			redirect(base_url()."movimientos/ordenes");

		}else{
			redirect(base_url()."movimientos/ordenes/edit/".$idPedido);
		}


		
	}

	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes){
		for ($i=0; $i < count($productos); $i++) { 
			$data  = array(
				'producto_id' => $productos[$i], 
				'venta_id' => $idventa,
				'precio' => $precios[$i],
				'cantidad' => $cantidades[$i],
				'importe'=> $importes[$i],
			);

			$this->Ventas_model->save_detalle($data);
			$productoActual = $this->Productos_model->getProducto($productos[$i]);
			if ($productoActual->condicion == "1") {
				$this->updateProducto($productos[$i],$cantidades[$i]);
				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->stock <= $productoActual->stock_minimo) {
					$data = array(
						'estado' => 0,
						'producto_id' => $productos[$i] 
					);
					$this->Ventas_model->saveNotificacion($data);
				}
			}

			$this->updateProductosAsociados($productos[$i]);
		}
	}


	public function pay($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			"clientes" => $this->Clientes_model->getClientes(),
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"comprobantePredeterminado" => $this->Ordenes_model->comprobantePredeterminado()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/pay",$data);
		$this->load->view("layouts/footer");
	}

	public function view(){
		$id = $this->input->post("idpedido");
		$data  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id), 
		);
		$this->load->view("admin/ordenes/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Ordenes_model->update($id,$data);
		echo "mantenimiento/ordenes";
	}

	public function getProductosByCategoria(){
		$idcategoria = $this->input->post("idcategoria");
		$productos = $this->Ordenes_model->getProductosByCategoria($idcategoria);
		echo json_encode($productos);
	}

	public function infoComprobante(){
		$id = $this->input->post("idcomprobante");
		$comprobante = $this->Ventas_model->getComprobante($id);
		echo json_encode($comprobante);
	}
}
