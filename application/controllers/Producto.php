<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ProductoModel');
        $this->load->library('twig');
        $this->load->helper('url');                
    }

	public function index() {
		$filtro = $this->input->get("filtro");
		$pagina = $this->input->get("pagina");
		if (!$pagina)
			$pagina = 1;
		$itemsPorPagina = 10;
		$skip = ($pagina-1)*$itemsPorPagina;

		$consulta = ProductoModel::where("codigo", "like", "%$filtro%")
							->orWhere("descripcion", "like", "%$filtro%")
							->take($itemsPorPagina);
		$totalRegistros = $consulta->count();
		$totalPaginas = ceil($totalRegistros/$itemsPorPagina);

		$datos["listado"] = $consulta->skip($skip)->get();
		$datos["base_url"] = base_url()."producto";
		$datos["pagina"] = $pagina;
		$datos["totalPaginas"] = $totalPaginas;
		$datos["filtro"] = $filtro;
		$this->twig->display('producto_list', $datos);
	}

	public function editar($id) {
		$datos["objeto"] =  ProductoModel::find($id);
		$datos["base_url"] = base_url()."producto";
		$this->twig->display('producto_edit', $datos);	
	}

	public function agregar() {
		$obj = new ProductoModel();
		$datos["objeto"] =  $obj;
		$datos["base_url"] = base_url()."producto";
		$this->twig->display('producto_edit', $datos);		
	}

	public function guardar() {
		if ($this->input->post("id")) {
			$producto = ProductoModel::find($this->input->post("id"));
		} else {
			$producto = new ProductoModel();
		}
		$producto->codigo = $this->input->post("codigo");
		$producto->descripcion = $this->input->post("descripcion");
		$producto->precio = $this->input->post("precio");
		$producto->save();
		redirect(base_url()."producto");
	}
}
