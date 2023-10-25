<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Categoria_model extends CI_Model
    {
        public function listaCategoria()
        {
            /*CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA */
            $this->db->select('*');//seleccionar todo 
            $this->db->from('categoria');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }

       //CONSULTA PARA INSERTAR EN LA BDD TABLA CATEGORIA
       public function agregarCategoria($data)
       {
           $this->db->insert('categoria',$data);//categoria es la tabla de BDD
       }

       //modelo encargado de llegar hasta la baseDD recupera los valores de los campos de la BDD
       public function recuperarCategoria($idcategoria)
       {
           $this->db->select('*');//seleccionar todo 
           $this->db->from('categoria');//de la tabla categoria
           $this->db->where('idCategoria',$idcategoria);//donde el id sea igual al idCategoria
           return $this->db->get();
       }

        //CONSULTA DE MODIFICAR TAMBIEN ES USADO PARA SOFTDELE
        public function modificarcategoria($idcategoria,$data)
        {
            $this->db->where('idCategoria',$idcategoria);
            $this->db->update('categoria',$data);
        }
        
        //lista de deshabilitados BORRA SOFTDELETE
        public function listaCategoriaDeshabi()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('categoria');//de la tabla categoria
            $this->db->where('estado','0');//donde el estado sea igual a 1
            return $this->db->get();
        }


    }
