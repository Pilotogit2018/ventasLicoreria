<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Marca_model extends CI_Model
    {
        public function listaMarcas()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA */
            $this->db->select('*');//seleccionar todo 
            $this->db->from('marca');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }

       //CONSULTA PARA INSERTAR EN LA BDD TABLA CATEGORIA
       public function agregarMarca($data)
       {
           $this->db->insert('marca',$data);//categoria es la tabla de BDD
       }

       //modelo encargado de llegar hasta la baseDD recupera los valores de los campos de la BDD
       public function recuperarMarca($idmarca)
       {
           $this->db->select('*');//seleccionar todo 
           $this->db->from('marca');//de la tabla categoria
           $this->db->where('idMarca',$idmarca);//donde el id sea igual al idCategoria
           return $this->db->get();
       }

        //CONSULTA DE MODIFICAR TAMBIEN ES USADO PARA SOFTDELE
        public function modificarMarca($idmarca,$data)
        {
            $this->db->where('idMarca',$idmarca);
            $this->db->update('marca',$data);
        }

        //lista de deshabilitados BORRA SOFTDELETE
        public function listaMarcasDeshabi()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('marca');//de la tabla categoria
            $this->db->where('estado','0');//donde el estado sea igual a 1
            return $this->db->get();
        }
        
    }