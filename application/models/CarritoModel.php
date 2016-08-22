<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class CarritoModel extends Eloquent {
    protected $table = "carrito";

    public $timestamps = false;

    public function items() {
    	return $this->hasMany('ItemCarritoModel', 'carrito_id', 'id');
    }

}
