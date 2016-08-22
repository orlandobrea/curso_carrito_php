<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ProductoModel');
        $this->load->model('CarritoModel');
        $this->load->model('ItemCarritoModel');
        $this->load->library('twig');
        $this->load->helper('url');
        $this->load->library('session');                
    }

    private function getCarrito() {
		$carrito_id = $this->session->carrito_id;
		$carrito = null;
		if (!$carrito_id) {
			$carrito = new CarritoModel();
			$carrito->temporal = true;
			$carrito->save();
			$this->session->carrito_id = $carrito->id;
		} else {
			$carrito = CarritoModel::find($carrito_id);
		}
		return $carrito;
    }

	public function index() {
		$filtro = $this->input->get("filtro");
		$pagina = $this->input->get("pagina");
		if (!$pagina)
			$pagina = 1;
		$itemsPorPagina = 9;
		$skip = ($pagina-1)*$itemsPorPagina;

		$consulta = ProductoModel::where("codigo", "like", "%$filtro%")
							->orWhere("descripcion", "like", "%$filtro%")
							->take($itemsPorPagina);
		$totalRegistros = $consulta->count();
		$totalPaginas = ceil($totalRegistros/$itemsPorPagina);

		$carrito = $this->getCarrito();
		$carrito->items();

		$datos["listado"] = $consulta->skip($skip)->get();
		$datos["base_url"] = base_url()."carrito";
		$datos["pagina"] = $pagina;
		$datos["totalPaginas"] = $totalPaginas;
		$datos["filtro"] = $filtro;
		$datos["carrito"] = $carrito;
		$this->twig->display('carrito_list', $datos);
	}



	public function agregar($id) {
		$obj = ProductoModel::find($id);
		if ($obj) {
			$carrito = $this->getCarrito();
			
			$item = ItemCarritoModel::where("carrito_id", "=", $carrito->id)
			                          ->where("producto_id", "=", $id)
			                          ->first();
			if (!$item) {
				$item = new ItemCarritoModel();
				$item->cantidad = 1;
				$carrito->cantidadItems++;
				$carrito->save();
				$item->producto_id = $id;
				$producto = ProductoModel::find($id);
				$item->precio = $producto->precio;
				$item->carrito_id = $carrito->id;
			} else {
				$item->cantidad++;
			}			
			$item->save();
		}
		redirect(base_url());	
	}

	public function borrar($id) {
		if (!$this->session->cliente_id) {
			redirect(base_url()."login");
		}
		$carrito = $this->getCarrito();
		foreach ($carrito->items as $unItem) {
			if($unItem->id==$id) {
				ItemCarritoModel::destroy($id);
			}
		}
		redirect(base_url()."/carrito/ver_carrito");
	}

	public function ver_carrito() {
		if (!$this->session->cliente_id) {
			redirect(base_url()."login");
		}
		$carrito = $this->getCarrito();
		$carrito->items;
		$total = 0;
		foreach ($carrito->items as $item) {
			$item->producto;
			$total += $item->precio * $item->cantidad;
		}
		$datos["carrito"] = $carrito;
		$datos["total"] = $total;
		$datos["base_url"] = base_url()."carrito";
		$this->twig->display('carrito_edit', $datos);
	}

	public function actualizar() {
		$carrito = $this->getCarrito();
		
		foreach ($this->input->post("id") as $id) {
			for ($i=0; $i < sizeof($carrito->items); $i++) { 
				if($carrito->items[$i]->id==$id) {
					$carrito->items[$i]->cantidad = $this->input->post("cantidad")[$i];
					$carrito->items[$i]->save();
				}
			}
		}
		redirect(base_url()."carrito/ver_carrito");
	}

	public function checkout() {
		if (!$this->session->cliente_id) {
			redirect(base_url()."login");
		}
		$carrito = $this->getCarrito();
		$carrito->items;
		$total = 0;
		foreach ($carrito->items as $item) {
			$item->producto;
			$total += $item->precio * $item->cantidad;
		}
		$datos["carrito"] = $carrito;
		$datos["total"] = $total;
		$datos["base_url"] = base_url()."carrito";
		$this->twig->display('carrito_fin', $datos);
	}
}
