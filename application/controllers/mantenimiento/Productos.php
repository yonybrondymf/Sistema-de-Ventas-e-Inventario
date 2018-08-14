<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	private $permisos;

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Categorias_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'productos' => $this->Productos_model->getProductos(), 
		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){
		
		$data =array( 
			"categorias" => $this->Categorias_model->getCategorias(),
			"productos" => $this->Productos_model->getProductos(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$stock = $this->input->post("stock");
		$categoria = $this->input->post("categoria");
		$stockminimo = $this->input->post("stockminimo");
		$condicion = $this->input->post("condicion");
		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");

		$this->form_validation->set_rules("codigo","Codigo","required|is_unique[productos.codigo]");
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");
		if ($condicion=="1") {
			$this->form_validation->set_rules("stock","Stock","required");
		}else{
			$stock = 1 ;
			$stockminimo = 0 ;
		}
		

		if ($this->form_validation->run()) {
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'stock' => $stock,
				'categoria_id' => $categoria,
				'estado' => "1",
				'stock_minimo' => $stockminimo,
				'condicion' => $condicion
			);
			$producto_id = $this->Productos_model->save($data);
			if ($producto_id != false) {
				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $producto_id,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/add");
			}
		}
		else{
			$this->add();
		}

		
	}

	public function edit($id){
		$data =array( 
			"producto" => $this->Productos_model->getProducto($id),
			"productosAsociados" => $this->Productos_model->getProductosA($id),
			"categorias" => $this->Categorias_model->getCategorias()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idproducto = $this->input->post("idproducto");
		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$stock = $this->input->post("stock");
		$categoria = $this->input->post("categoria");
		$stockminimo = $this->input->post("stockminimo");
		$condicion = $this->input->post("condicion");

		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");

		$productoActual = $this->Productos_model->getProducto($idproducto);

		if ($codigo == $productoActual->codigo) {
			$is_unique = '';
		}
		else{
			$is_unique = '|is_unique[productos.codigo]';
		}

		$this->form_validation->set_rules("codigo","Codigo","required".$is_unique);
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");
		if ($condicion=="1") {
			$this->form_validation->set_rules("stock","Stock","required");
		}else{
			$stock = 1 ;
			$stockminimo = 0 ;
		}

		if ($this->form_validation->run()) {
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'stock' => $stock,
				'categoria_id' => $categoria,
				'stock_minimo' => $stockminimo,
				'condicion' => $condicion
			);
			if ($this->Productos_model->update($idproducto,$data)) {

				$this->Productos_model->deleteProductosAsociados($idproducto);

				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $idproducto,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/edit/".$idproducto);
			}
		}else{
			$this->edit($idproducto);
		}

		
	}
	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Productos_model->update($id,$data);
		
		echo "mantenimiento/productos";
	}

	public function view($id){
		$data  = array(
			'producto' => $this->Productos_model->getProducto($id), 
			'productosA' => $this->Productos_model->getProductosA($id), 

		);
		$this->load->view("admin/productos/view",$data);
	}

}