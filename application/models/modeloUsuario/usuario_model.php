<?php
//EN ESTA AREA DE MODEL SE HACEN LAS CONSULTAS

    class Usuario_model extends CI_Model{

        public function validar($login, $password)
        {
            $this->db->select('*');//editar posiblemente solo se necesito el usuario y contraseña
            $this->db->from('usuario');//
            $this->db->where('nombreUsuario',$login);//donde nombre usuario sea igual al login
            $this->db->where('contrasenia',$password);//donde contrasenia sea igual al password
            return $this->db->get();
        }

      
        public function listaUsuario()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('usuario');//de la tabla categoria
            $this->db->where('estado','1');//donde el estado sea igual a 1
            return $this->db->get();
        }
        

        //CONSULTA PARA INSERTAR EN LA BDD TABLA USUARIOS
        public function agregarUsuario($data)
        {
            $this->db->insert('usuario',$data);//categoria es la tabla de BDD
        }

        //modficar
        public function recuperarusuario($idusuario)
        {
            $this->db->select('*');
            $this->db->from('usuario');
            $this->db->where('idUsuario',$idusuario);
            return $this->db->get();
        }
        
        //CONSULTA DE MODIFICAR
        public function modificarusuario($idusuario,$data)
        {
            $this->db->where('idUsuario',$idusuario);
            $this->db->update('usuario',$data);
        }

        public function listaUsuarioDeshabi()
        {
            //CONSULTA PARA SACAR LA LISTA DE LA CATEGORIA 
            $this->db->select('*');//seleccionar todo 
            $this->db->from('usuario');//de la tabla categoria
            $this->db->where('estado','0');//donde el estado sea igual a 1
            return $this->db->get();
        }

    }
