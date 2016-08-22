<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ClienteModel');
        $this->load->library('twig');
        $this->load->helper('url');
        $this->load->library('session');                
    }

    public function index() {
    	$datos["base_url"] = base_url()."login";
    	$this->twig->display('login', $datos);
    }

    public function registrarme() {
    	$datos["base_url"] = base_url()."login";
    	$this->twig->display('registrarme', $datos);
    }

    public function procesar_registro() { 
    	$usuario = new ClienteModel();
    	$usuario->nombre = $this->input->post("nombre");
    	$usuario->email = $this->input->post("email");
    	$usuario->pass = $this->input->post("pass");
    	$usuario->save();
    	$this->session->cliente_id = $usuario->id;
    	redirect(base_url()."carrito/ver_carrito");    	
    }

    public function procesar_login() {
    	$email = $this->input->post("email");
    	$pass = $this->input->post("pass");
    	$usuario = ClienteModel::where("email", "=", $email)->where("pass", "=", $pass)->first();
    	if (!$usuario) {
        	$datos["base_url"] = base_url()."login";
        	$datos["error"] = "Email/Password incorrectos";
    		$this->twig->display('login', $datos);		
    	} else {
    		$this->session->cliente_id = $usuario->id;
    		redirect(base_url()."carrito/ver_carrito");
    	}
    }

    public function logout() {
    	$this->session->cliente_id = null;
    	redirect(base_url()."carrito");
    }
}
