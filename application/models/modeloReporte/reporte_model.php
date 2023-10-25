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


     //REPORTE GENERAL POR FECHAS
     public function ventaFechas($Inicio,$Fin) //select
     {
         $this->db->select('venta.idVenta, venta.totalVenta, venta.estado, venta.fechaRegistro, venta.fechaActualizacion, cliente.idCliente, cliente.razonSocial, 
                    cliente.ciNit, usuario.idUsuario, usuario.nombreUsuario, usuario.nombre, usuario.primerApellido,  usuario.segundoApellido, detalleventa.precioUnitario, 
                    detalleventa.cantidad, producto.nombre, producto.cantidad, producto.precioUnitario, categoria.nombre as nombrec, 
                    marca.nombre as nombrem, proveedor.nombre as razonSocial');  //select *
         $this->db->from('venta'); //tabla productos
         $this->db->join('cliente', 'venta.idCliente = cliente.idCliente');
         $this->db->join('usuario', 'venta.idUsuario = usuario.idUsuario');
         $this->db->join('detalleventa', 'venta.idVenta = detalleventa.idVenta');
         $this->db->join('producto', 'producto.idProducto = detalleventa.idProducto');
         $this->db->join('categoria', 'producto.idCategoria = categoria.idCategoria');
         $this->db->join('marca', 'producto.idMarca = marca.idMarca');
         $this->db->join('proveedor', 'producto.idProveedor = proveedor.idProveedor');
         $this->db->where('venta.estado','1');
         $this->db->where("venta.fechaRegistro BETWEEN'{$Inicio}' AND '{$Fin},23:59:59'");
         $this->db->order_by('venta.fechaRegistro', 'desc');
         //$this->db->group_by('venta.idVenta'); 
         return $this->db->get(); 
     }

     public function buscarID($idVenta) //select
    {

      $this->db->select('venta.idVenta, venta.total, venta.estado, venta.fechaRegistro, venta.fechaActualizacion, cliente.idCliente, cliente.nombres, 
                  cliente.primerApellido, cliente.segundoApellido, cliente.cedulaIdentidad, usuario.idUsuario, usuario.login,
                  sucursal.idSucursal, sucursal.nombreSucursal, sucursal.direccion, detalleventa.precioVenta, detalleventa.cantidad, 
                  producto.nroChasis, producto.color, modelo.nombreModelo, marca.nombreMarca'); //select *
      $this->db->from('venta'); //tabla productos
      $this->db->where('venta.estado', '1'); //condición where estado = 1
      $this->db->where('venta.idVenta', $idVenta);
      $this->db->join('cliente', 'venta.idCliente = cliente.idCliente');
      $this->db->join('usuario', 'venta.idUsuario = usuario.idUsuario');
      $this->db->join('sucursal', 'usuario.idSucursal = sucursal.idSucursal');
      $this->db->join('detalleventa', 'venta.idVenta = detalleventa.idVenta');
      $this->db->join('producto', 'producto.idProducto = detalleventa.idProducto');
      $this->db->join('modelo', 'producto.idModelo = modelo.idModelo');
      $this->db->join('marca', 'producto.idMarca = marca.idMarca');
      $this->db->group_by('venta.idVenta'); 
      $this->db->order_by('venta.idVenta','desc');


      return $this->db->get(); //devolucion del resultado de la consulta
   }

   	public function listaProductosGeneral()
	{
       $this->db->select('P.idProducto, P.color, P.anioModelo, P.nroChasis, P.nroMotor, 
                        P.poliza, P.precio, P.estado, P.fechaRegistro, P.fechaActualizacion,
                        P.idMarca, MA.nombreMarca, P.idModelo, MO.nombreModelo, S.nombreSucursal'); //select *
       $this->db->from('producto P'); //tabla
       $this->db->where('P.estado','1');
       $this->db->join('marca MA', 'P.idMarca=MA.idMarca');
       $this->db->join('modelo MO', 'P.idModelo=MO.idModelo');
       $this->db->join('sucursal S', 'P.idSucursal=S.idSucursal');
       $this->db->order_by('idProducto', 'desc');
       return $this->db->get(); //devolucion del resultado de la consulta
	}

   	public function listaProductosSucursal($idSucursal)
	{
       $this->db->select('P.idProducto, P.color, P.anioModelo, P.nroChasis, P.nroMotor, 
                        P.poliza, P.precio, P.estado, P.fechaRegistro, P.fechaActualizacion,
                        P.idMarca, MA.nombreMarca, P.idModelo, MO.nombreModelo, S.nombreSucursal'); //select *
       $this->db->from('producto P'); //tabla
       $this->db->where('P.estado','1');
       $this->db->where('S.idSucursal',$idSucursal);
       $this->db->join('marca MA', 'P.idMarca=MA.idMarca');
       $this->db->join('modelo MO', 'P.idModelo=MO.idModelo');
       $this->db->join('sucursal S', 'P.idSucursal=S.idSucursal');
       $this->db->order_by('idProducto', 'desc');
       return $this->db->get(); //devolucion del resultado de la consulta
	}

    public function listaClientesGeneral()
	{
        $this->db->select('C.idCliente, C.nombres, C.primerApellido, C.segundoApellido, C.cedulaIdentidad, C.telefono, 
                        C.direccion, C.estado, C.fechaRegistro, C.fechaActualizacion, U.idUsuario, U.login, 
                        S.idSucursal, S.nombreSucursal'); //select *
        $this->db->from('cliente C'); //tabla
        $this->db->join('usuario U', 'C.idUsuario=U.idUsuario');
        $this->db->join('sucursal S', 'C.idSucursal=S.idSucursal');
        $this->db->where('C.estado','1');
        $this->db->order_by('idCliente', 'desc');
        return $this->db->get(); //devolucion del resultado de la consulta
	}

    public function listaClientesSucursal($idSucursal)
	{
        $this->db->select('C.idCliente, C.nombres, C.primerApellido, C.segundoApellido, C.cedulaIdentidad, C.telefono, 
                        C.direccion, C.estado, C.fechaRegistro, C.fechaActualizacion, U.idUsuario, U.login, 
                        S.idSucursal, S.nombreSucursal'); //select *
        $this->db->from('cliente C'); //tabla
        $this->db->join('usuario U', 'C.idUsuario=U.idUsuario');
        $this->db->join('sucursal S', 'C.idSucursal=S.idSucursal');
        $this->db->where('C.estado','1');
        $this->db->where('S.idSucursal',$idSucursal);
        $this->db->order_by('idCliente', 'desc');
        return $this->db->get(); //devolucion del resultado de la consulta
	}

    public function listaUsuarios()
	{
                $this->db->select('U.idUsuario, U.login, U.tipo, U.nombres, U.primerApellido, U.segundoApellido, U.cedulaIdentidad, 
                U.telefono, U.direccion, U.estado, U.fechaRegistro, U.fechaActualizacion, S.idSucursal, S.nombreSucursal'); //select *
                $this->db->from('usuario U'); //tabla
                $this->db->where('U.estado','1');
                $this->db->join('sucursal S', 'S.idSucursal=U.idSucursal');
                return $this->db->get(); //devolucion del resultado de la consulta
	}

}
