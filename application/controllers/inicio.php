<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Inicio extends CI_Controller{

        public function index()
        {
            if($this->session->userdata('login'))
		    {
                $tipo = $this->session->userdata('rol');
                if($tipo == 'administrador')
                {
                    $this->load->view('administrador/cuerpoLte/cabecera');
                    $this->load->view('administrador/cuerpoLte/menuSuperior');
                    $this->load->view('administrador/cuerpoLte/menuLateral');
                    $this->load->view('administrador/cuerpoLte/principal');
                    $this->load->view('administrador/cuerpoLte/pie');
                }
                else
                {
                    
                $this->load->view('empleado/cuerpoLte/cabecera');
                $this->load->view('empleado/cuerpoLte/menuSuperior');
                $this->load->view('empleado/cuerpoLte/menuLateral');
                $this->load->view('empleado/cuerpoLte/principal');
                $this->load->view('empleado/cuerpoLte/pie');

                }
               
            }
            else
            {
                $data['mensaje']=$this->uri->segment(3);//
			    $this->load->view('logins/login',$data);//vista del login
            }
            

        }
    }




  