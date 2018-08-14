<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	private $permisos;
	public $products;
	public function __construct(){
		parent::__construct();

		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ventas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
		$this->load->model("Ordenes_model");
		if (empty($this->products)) {
			$this->products = $this->Ventas_model->getProducts();
		}
		
	}

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
			'ventas' => $this->Ventas_model->getVentas(date("Y-m-d")), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/list",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){

		$data = array(
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"tipoclientes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos(),
			"estado" => "2",
			"productos" => $this->Ventas_model->getProducts(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/add",$data);
		$this->load->view("layouts/footer");
	}

	public function getproductos(){

		$stockProducto = $this->products;

		$valor = $this->input->post("valor");
		$productos = $this->Ventas_model->getproductos($valor);
		$productosAutcomplete = array();
		foreach ($productos as $producto) {
			$productos_asociados = $this->Productos_model->getProductosA($producto["id"]);

			if (!empty($productos_asociados)) {
				$verificacion = 0;
				foreach ($productos_asociados as $productoA) {
					//recuperamos la informacion de los productos Asociados
					$productoAsociadoActual = $this->Productos_model->getProducto($productoA->producto_asociado);
					//comparamos el stock del producto con la cantidad del producto asociado
					if ($stockProducto[$productoA->producto_asociado]['stock'] >= $productoA->cantidad) {
						$verificacion= $verificacion + 1;
					}
				}

				if ($verificacion == count($productos_asociados)) {
					$productosAutcomplete[] = $producto;
				}
			}else{
				if ($this->products[$producto['id']]['stock'] >= 1) {
					$productosAutcomplete[] = $producto;
				}
			}

		}

		echo json_encode($productosAutcomplete);
	}

	/*public function getproductos(){
		$valor = $this->input->post("valor");
		$productos = $this->Ventas_model->getproductos($valor);
		$productosAutcomplete = array();
		foreach ($productos as $producto) {
			$productos_asociados = $this->Productos_model->getProductosA($producto["id"]);
			//verificar si hay productos asociados
			if (!empty($productos_asociados)) {
				$verificacion = false;
				foreach ($productos_asociados as $productoA) {
					//recuperamos la informacion de los productos Asociados
					$productoAsociadoActual = $this->Productos_model->getProducto($productoA->producto_asociado);
					//comparamos el stock del producto con la cantidad del producto asociado
					if ($productoAsociadoActual->stock >= $productoA->cantidad) {
						$verificacion = true;
					}
					else{
						$verificacion = false;
					}
				}

				if ($verificacion != false) {
					$productosAutcomplete[] = $producto;
				}
			}else{
				$productosAutcomplete[]= $producto;
			}
		}
		echo json_encode($productosAutcomplete);
	}*/
	//metodo para mostrar productos en la accion de asociar
	public function getproductosA(){
		$valor = $this->input->post("valor");
		$productos = $this->Ventas_model->getproductosA($valor);
		echo json_encode($productos);
	}

	public function store(){
		$fecha = date("Y-m-d");
		$idPedido = $this->input->post("idPedido");
		$subtotal = $this->input->post("subtotal");
		$iva = $this->input->post("iva");
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$idcomprobante = $this->input->post("idComprobante");
		$idcliente = $this->input->post("idcliente");
		$idusuario = $this->session->userdata("id");
		$numero = $this->input->post("numero");
		$serie = $this->input->post("serie");
		$estado = 1;
		$estadoPedido = $this->input->post("estadoPedido");

		$idproductos = $this->input->post("productos");
		$precios = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$pedidoproductos = $this->input->post("pedidoproductos");

		$data = array(
			'fecha' => $fecha,
			'subtotal' => $subtotal,
			'igv' => $iva,
			//'iva' => $iva,
			'descuento' => $descuento,
			'total' => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'cliente_id' => $idcliente,
			'usuario_id' => $idusuario,
			'num_documento' => $numero,
			'serie' => $serie,
			'estado' => $estado
		);

		if ($this->Ventas_model->save($data)) {
			$idventa = $this->Ventas_model->lastID();
			$this->updateComprobante($idcomprobante);
			$this->updatePedidoProductos($pedidoproductos);
			$this->save_detalle($idproductos,$idventa,$precios,$cantidades,$importes);
			if ($estadoPedido == 1) {
				$mesas = $this->Ordenes_model->getPedidosMesas($idPedido);
				$dataMesa = array(
					"estado" => 1
				);

				foreach ($mesas as $mesa) {
					$this->Ordenes_model->updateMesa($mesa->id,$dataMesa);
				}

				$dataPedido = array("estado" => 0);
				$this->Ordenes_model->update($idPedido,$dataPedido);
			}
			
			$data = array(
				"venta" => $this->Ventas_model->getVenta($idventa),
				"detalles" =>$this->Ventas_model->getDetalle($idventa)
			);
			$this->load->view("admin/ventas/view2",$data);

		}else{
			//redirect(base_url()."movimientos/ventas/add");
			echo "0";
		}
	}

	protected function updatePedidoProductos($pedidoproductos){
		for ($i=0; $i < count($pedidoproductos); $i++) { 
			$data  = array(
				"estado" => 1
			);

			$this->Ordenes_model->updatePedidoProductos($pedidoproductos[$i],$data);
		}
	}

	protected function updateComprobante($idcomprobante){
		$comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
		$data  = array(
			'cantidad' => $comprobanteActual->cantidad + 1, 
		);
		$this->Ventas_model->updateComprobante($idcomprobante,$data);
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
			/*$productoActual = $this->Productos_model->getProducto($productos[$i]);
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

			$this->updateProductosAsociados($productos[$i]);*/
		}
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

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getProducto($idproducto);
		$data = array(
			'stock' => $productoActual->stock - $cantidad, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	public function view(){
		$idventa = $this->input->post("id");
		$data = array(
			"venta" => $this->Ventas_model->getVenta($idventa),
			"detalles" =>$this->Ventas_model->getDetalle($idventa)
		);
		$this->load->view("admin/ventas/view2",$data);
	}

	public function edit($id)
	{
		$data  = array(
			'venta' => $this->Ventas_model->getVenta($id), 
			"detalles" =>$this->Ventas_model->getDetalle($id),
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"estado" => "2",
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function savecliente(){
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$data  = array(
			'nombre' => $nombre, 
			'tipo_documento_id' => $tipodocumento,
			'tipo_cliente_id' => $tipocliente,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'num_documento' => $num_documento,
			'estado' => "1"
		);
		$cliente = $this->Ventas_model->savecliente($data);
		if (!$cliente) {
			echo "0";
		}
		else{
			$data  = array(
				'id' => $cliente, 
				'nombres' => $nombre,
			);
			echo json_encode($data);
		}
		
	}

	public function update(){
		$idventa = $this->input->post("idventa");
		$fecha = $this->input->post("fecha");
		$subtotal = $this->input->post("subtotal");
		$iva = $this->input->post("iva");
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$idcomprobante = $this->input->post("idcomprobante");
		$idcliente = $this->input->post("idcliente");
		$idusuario = $this->session->userdata("id");
		$numero = $this->input->post("numero");
		$serie = $this->input->post("serie");
		$estado = $this->input->post("estado");

		$idproductos = $this->input->post("idproductos");
		$precios = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");

		$data = array(
			'fecha' => $fecha,
			'subtotal' => $subtotal,
			'igv' => $iva,
			'descuento' => $descuento,
			'total' => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'cliente_id' => $idcliente,
			'usuario_id' => $idusuario,
			'num_documento' => $numero,
			'serie' => $serie,
			'estado' => $estado
		);

		$detalles = $this->Ventas_model->getDetalle($idventa);
        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);


            $productosAsociados = $this->Productos_model->getProductosA($detalle->producto_id);

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
            	$this->Productos_model->update($detalle->producto_id,$dataProducto);

            }

        }
        $this->Ventas_model->deleteDetail($idventa);
        //reponer cantidad de productos asociados
        /*for($i = 0; $i < count($idproductos); $i++){
        	$productosAsociados = $this->Productos_model->getProductosA($idproductos[$i]);

        	foreach ($productosAsociados as $productoA) {
        		$infoproductoA = $this->Productos_model->getProducto($productoA->producto_asociado);

        		$dataProductoA = array(
                    'stock' => $infoproductoA->stock + $productoA->cantidad, 
                );

                $this->Productos_model->update($productoA->producto_asociado,$dataProductoA);

        	}


        }*/


        if ($this->Ventas_model->update($idventa, $data)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            for ($i = 0; $i < count($idproductos);$i++) {
                $infoproducto = $this->Productos_model->getProducto($idproductos[$i]);

                $dataProducto = array(
                    'stock' => $infoproducto->stock - $cantidades[$i], 
                );

                if ($infoproducto->condicion == "1") {
                	$this->Productos_model->update($idproductos[$i],$dataProducto);
                	$productoActual = $this->Productos_model->getProducto($idproductos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $idproductos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
	            }


                $dataDetalle  = array(
                    'venta_id'     => $idventa, 
                    'producto_id'     => $idproductos[$i],
                    'cantidad' => $cantidades[$i],
                    'precio' => $precios[$i],
                    'importe' => $importes[$i],
                );

                $this->Ventas_model->save_detalle($dataDetalle);
                $this->updateProductosAsociados($idproductos[$i]);
            }
            echo "1";
            //redirect(base_url() . "movimientos/ventas");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            //redirect(base_url() . "movimientos/ventas/edit/" . $idarea);
            echo "0";
        }
	}


    public function delete($idventa)
    {
       
        $detalles = $this->Ventas_model->getDetalle($idventa);
        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);

            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            $this->Productos_model->update($detalle->producto_id,$dataProducto);
        }
        //$this->Ventas_model->deleteDetail($idventa);
        $data  = array(
            'estado' => "0", 
        );
        $this->Ventas_model->update($idventa,$data);
        echo "movimientos/ventas";

    }

    public function pagar(){
    	$idventa = $this->input->post("id");

    	$data  = array(
            'estado' => "1", 
        );
        $this->Ventas_model->update($idventa,$data);
        echo "movimientos/ventas";
    }

    public function comprobarPassword(){
    	$password = $this->input->post("password");

    	if (!$this->Ventas_model->comprobarPassword($password)) {
    		echo "0";
    	}else{
    		echo "1";
    	}
    }

    public function descontarStock(){
    	$idproducto = $this->input->post("idproducto");
    	$stock = $this->input->post("stock");
    	$asociado = $this->input->post("asociado");

    	$this->products[$idproducto]['stock'] = $this->products[$idproducto]['stock'] - $stock;
    	echo json_encode($this->products);



    }

    public function verStock(){
    	
    	echo json_encode($this->products);



    }

}