<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ItemCarritoModel extends Eloquent {
    protected $table = "itemcarrito";

    public $timestamps = false;

    public function producto() {
    	return $this->hasOne('ProductoModel', 'id', 'producto_id');
    }

    public function carrito() {
    	return $this->belongsTo('Carrito', 'id', 'carrito_id');
    }

}
