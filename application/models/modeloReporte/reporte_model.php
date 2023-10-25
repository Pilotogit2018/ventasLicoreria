<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Reporte_model extends CI_Model{


        public function ventashistorial() //select
        {
          $this->db->select('venta.idVenta, venta.totalVenta, venta.estado, venta.fechaRegistro, venta.fechaActualizacion, cliente.idCliente, cliente.razonSocial, 
                     cliente.ciNit, usuario.idUsuario, usuario.nombreUsuario, usuario.nombre, usuario.primerApellido,  usuario.segundoApellido, detalleventa.precioUnitario, 
                     detalleventa.cantidad, producto.nombre, producto.cantidad, producto.precioUnitario, categoria.nombre as nombrec, 
                     marca.nombre as nombrem, proveedor.nombre as razonSocialp'); //select *
          $this->db->from('venta'); //tabla productos
          $this->db->where('venta.estado', '1'); //condición where estado = 1
          $this->db->join('cliente', 'venta.idCliente = cliente.idCliente');
          $this->db->join('usuario', 'venta.idUsuario = usuario.idUsuario');
          $this->db->join('detalleventa', 'venta.idVenta = detalleventa.idVenta');
          $this->db->join('producto', 'producto.idProducto = detalleventa.idProducto');
          $this->db->join('categoria', 'producto.idCategoria = categoria.idCategoria');
          $this->db->join('marca', 'producto.idMarca = marca.idMarca');
          $this->db->join('proveedor', 'producto.idProveedor = proveedor.idProveedor');
          $this->db->order_by('venta.idVenta', 'desc');
          $this->db->group_by('venta.idVenta'); 
          //si se gusta añadir una especie de AND de SQL se puede repetir nuevamente la línea previa a este comentario. ($this->db->where('estado','1');)
          return $this->db->get(); //devolucion del resultado de la consulta
        }

    // PDF -> Reporte suma del total en NUMERAL de ventas
    public function reporteTotal()
	{
        $this->db->select('sum(totalVenta) as total');
        $this->db->from ('venta');
        return $this->db->get(); 
    }

    }
