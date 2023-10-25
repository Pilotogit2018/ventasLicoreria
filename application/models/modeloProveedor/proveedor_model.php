<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Proveedor_model extends CI_Model
    {
        public function listaProveedores()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA */
            $this->db->select('*');//seleccionar todo 
            $this->db->from('proveedor');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }

       //CONSULTA PARA INSERTAR EN LA BDD TABLA CATEGORIA
       public function agregarProveedor($data)
       {
           $this->db->insert('proveedor',$data);//categoria es la tabla de BDD
       }

       //modelo encargado de llegar hasta la baseDD recupera los valores de los campos de la BDD
       public function recuperarProveedor($idproveedor)
       {
           $this->db->select('*');//seleccionar todo 
           $this->db->from('proveedor');//de la tabla categoria
           $this->db->where('idProveedor',$idproveedor);//donde el id sea igual al idCategoria
           return $this->db->get();
       }

        //CONSULTA DE MODIFICAR TAMBIEN ES USADO PARA SOFTDELE
        public function modificarProveedor($idproveedor,$data)
        {
            $this->db->where('idProveedor',$idproveedor);
            $this->db->update('proveedor',$data);
        }

        //lista de deshabilitados BORRA SOFTDELETE
        public function listaProveedorDeshabi()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA */
            $this->db->select('*');//seleccionar todo 
            $this->db->from('proveedor');//de la tabla categoria
            $this->db->where('estado','0');//donde el estado sea igual a 1
            return $this->db->get();
        }
    }
