<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index($nombre)
	{
		$datos = array("nombre" => $nombre);

		$this->load->library('parser');
		$this->parser->parse('test', $datos);
	}


	public function listar()
	{
		$datos = array("personas" => array(
			array("nombre" => "Orlando"),
			array("nombre" => "Juan"),
			array("nombre" => "Maria")
			));

		$this->load->library('parser');
		$this->parser->parse('list', $datos);
	}
}
