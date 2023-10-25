<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax  extends CI_Controller
{
    public function obtenerProductoPorId($producto_id)
    {
        $producto = $this->venta_model->obtenerProductoPorId($producto_id);

        echo json_encode($producto);
    }
    
}

