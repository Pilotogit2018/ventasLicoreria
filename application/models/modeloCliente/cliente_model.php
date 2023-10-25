<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Cliente_model extends CI_Model
    {
        public function listaClientes()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA */
            $this->db->select('*');//seleccionar todo 
            $this->db->from('cliente');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }

       //CONSULTA PARA INSERTAR EN LA BDD TABLA CATEGORIA
       public function agregarCliente($data)
       {
           $this->db->insert('cliente',$data);//categoria es la tabla de BDD
       }

       //modelo encargado de llegar hasta la baseDD recupera los valores de los campos de la BDD
       public function recuperarCliente($idcliente)
       {
           $this->db->select('*');//seleccionar todo 
           $this->db->from('cliente');//de la tabla categoria
           $this->db->where('idCliente',$idcliente);//donde el id sea igual al idCategoria
           return $this->db->get();
       }

        //CONSULTA DE MODIFICAR TAMBIEN ES USADO PARA SOFTDELE
        public function modificarCliente($idcliente,$data)
        {
            $this->db->where('idCliente',$idcliente);
            $this->db->update('cliente',$data);
        }

        //lista de deshabilitados BORRA SOFTDELETE
        public function listaClientesDeshabi()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('cliente');//de la tabla categoria
            $this->db->where('estado','0');//donde el estado sea igual a 1
            return $this->db->get();
        }
        
    }