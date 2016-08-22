<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ClienteModel');
        $this->load->library('twig');
        $this->load->helper('url');                
    }

	public function index() {
		$datos["listado"] =  ClienteModel::all();
		$datos["base_url"] = base_url()."cliente";
		$this->twig->display('cliente_list', $datos);
	}

	public function editar($id) {
		$datos["objeto"] =  ClienteModel::find($id);
		$datos["base_url"] = base_url()."cliente";
		$this->twig->display('cliente_edit', $datos);	
	}

	public function agregar() {
		$obj = new ClienteModel();
		$datos["objeto"] =  $obj;
		$datos["base_url"] = base_url()."cliente";
		$this->twig->display('cliente_edit', $datos);		
	}

	public function guardar() {
		if ($this->input->post("id")) {
			$cliente = ClienteModel::find($this->input->post("id"));
		} else {
			$cliente = new ClienteModel();
		}
		$cliente->nombre = $this->input->post("nombre");
		$cliente->razonSocial = $this->input->post("razonSocial");
		$cliente->cuit = $this->input->post("cuit");
		$cliente->save();
		redirect(base_url()."cliente");
	}
}
