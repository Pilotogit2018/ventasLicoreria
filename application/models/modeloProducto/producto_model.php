<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Producto_model extends CI_Model
    {
        public function listaProducto()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('producto');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();*/

            $this->db->select('p.idProducto, p.nombre, p.descripcion, p.cantidad, p.precioUnitario, p.estado, p.fechaRegistro, p.fechaActualizacion, p.idMarca, m.nombre as nombreMarca, p.idCategoria, c.nombre as nombreCategoria, p.idProveedor, pvd.nombre as nombreProveedor');
            $this->db->from('producto p');
            $this->db->join('marca m', 'p.idMarca = m.idMarca');
            $this->db->join('categoria c', 'p.idCategoria = c.idCategoria');
            $this->db->join('proveedor pvd','p.idProveedor = pvd.idProveedor');
            $this->db->where('p.estado','1');
            return $this->db->get();
        }

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
        }
    }