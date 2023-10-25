<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Venta_model extends CI_Model
    {
/*
        public function listaVentas()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('venta');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }
*/
        public function listaVentas()
        {
            $this->db->select('*');
            $this->db->from('venta');
            $this->db->where('estado','1');
            return $this->db->get();
        }

        public function obtenerProductoPorId($producto_id)
        {
            $this->db->select('idProducto, nombre, cantidad, precioUnitario');
            $this->db->from('producto');
            $this->db->where('estado', 1);
            $this->db->where('cantidad >=', 1);
            $this->db->where('idProducto', $producto_id);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        public function agregarVenta($idCliente, $total, $idUsuario, $detalle_data)
        {
            // Inicia una transacción en la base de datos
            $this->db->trans_start();
    
            $fecha = date("Y-m-d H:i:s");
    
    
            $venta = array(
                'fecha' => $fecha,
                'totalVenta' => $total,
                'idUsuario' => $idUsuario,
                'idCliente' => $idCliente
            );
    
            $this->db->insert('venta', $venta);
    
    
            $idVenta = $this->db->insert_id();
    
            // Inserta los detalles de la venta en la tabla 'detalle'
            $detalle_venta = json_decode($detalle_data, true);
    
            foreach ($detalle_venta as $detalle) {
                $detalle['idVenta'] = $idVenta;
    
                $this->db->insert('detalleventa', $detalle);
            }
    
            foreach ($detalle_venta as $detalle) {
                $this->db->where('idProducto', $detalle['idProducto']);//$this->db->where('id', $detalle['idProducto']); antes
                $currentStock = (int) $this->db->get('producto')->row()->cantidad;
    
                // Asegúrate de que $detalle['cantidad'] sea un número válido
                $cantidad = (int) $detalle['cantidad'];
    
                if ($currentStock >= $cantidad) {
                    $newStock = $currentStock - $cantidad;
                    $this->db->where('idProducto', $detalle['idProducto']);
                    $this->db->update('producto', array('cantidad' => $newStock));
                }
            }
    
            // Completa la transacción en la base de datos
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                // Si ocurrió un error en la transacción, puedes manejarlo aquí
                return false;
            } else {
                // La transacción se completó exitosamente
                return true;
            }
        }
      /*  
        public function registrarProducto($idCategoria,$idMarca,$idProveedor,$data2)
        {
            $this->db->trans_start();

                $idProducto=$this->db->insert_id();

                $data2['idCategoria']=$idCategoria;
                $data2['idMarca']=$idMarca;
                $data2['idProducto']=$idProducto;
                $data2['idProveedor']=$idProveedor;

                $this->db->insert('producto',$data2);

                $this->db->trans_complete();
                if($this->db->trans_status()==FALSE)
                {
                    return false;
                }
        }*/
    }