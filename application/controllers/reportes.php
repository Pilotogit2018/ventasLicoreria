<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
   
    public function lista()
	{
        if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaReporte/lista_reporte');//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
    }

	// REPORTE GENERAL DE VENTAS
    public function reporteGeneral()
    {
        $lista = $this->reporte_model->ventashistorial();
        $data['fecha'] = $lista;

        $lista = $this->reporte_model->reporteTotal();
        $data['total'] = $lista;

        $this->load->view('inc/cabecera');
        $this->load->view('inc/menulateral');
        $this->load->view('inc/menusuperior');
        $this->load->view('reporte/reportes_generales',$data);
        $this->load->view('inc/creditos');	
        $this->load->view('inc/pie');
    }
 



}