<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductoModel extends Eloquent {
    protected $table = "producto";

    public $timestamps = false;
}
