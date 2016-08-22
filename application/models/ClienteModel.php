<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ClienteModel extends Eloquent {
    protected $table = "cliente";

    public $timestamps = false;
    
    public $primaryKey = "id";
}
