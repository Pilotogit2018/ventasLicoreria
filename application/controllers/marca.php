<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {
   
    public function lista()
	{
		//AÑADIR AQUI EL LOGIN
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{
				$lista=$this->marca_model->listaMarcas();
				$data['marca']=$lista;

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaMarca/marca_lista',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else{
				$lista=$this->marca_model->listaMarcas();
				$data['marca']=$lista;

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaMarca/marca_lista',$data);//vista de la categoria
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
	}

        /*para ir al formulario de agregar */
	public function agregarMarcaLte()
	{
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{
				//mostrar formulario para agregar categoria
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaMarca/formularios/formMarca_agregar');
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				//mostrar formulario para agregar categoria
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaMarca/formularios/formMarca_agregar');
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}	
	}

    //CRUD METODO INSERTAR NECESARIO
	public function agregarbd()
	{  
		$this->load->library('form_validation');

		$this->form_validation->set_rules('NAME','marca','required|min_length[3]|max_length[20]|alpha_numeric_spaces',
										array('required'=>'se requiere la marca','min_length'=>'por lo menos 3 caracteres','max_lenght'=>'maximo 20 caracteres'));
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('administrador/cuerpoLte/cabecera');
			$this->load->view('administrador/cuerpoLte/menuSuperior');
			$this->load->view('administrador/cuerpoLte/menuLateral');
			$this->load->view('administrador/vistaMarca/formularios/formMarca_agregar');
			$this->load->view('administrador/cuerpoLte/pie');
		}
		else{
			//atributo bdd nombre   //formulario=NAME
		$data['nombre']=$_POST['NAME'];

		$this->marca_model->agregarMarca($data);//los datos nombre y descricion de mandan a categoria_model luego al metodo agregarCategoria con variable data
		
		redirect('marca/lista','refresh');
		}
		
	
	}
    

    //FUNCION MOFIFICAR NECESARIO RECUPERADATOSCATEGORIA
	public function modificar()
	{
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$idmarca=$_POST['idmarca'];
				$data['infoMarca']=$this->marca_model->recuperarMarca($idmarca);
			
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaMarca/formularios/modificar_marca',$data);//vista de la categor
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else{
				$idmarca=$_POST['idmarca'];
				$data['infoMarca']=$this->marca_model->recuperarMarca($idmarca);
			
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaMarca/formularios/modificar_marca',$data);//vista de la categor
				$this->load->view('empleado/cuerpoLte/pie');
			}
			
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}	


	}

	//FUNCION DE MOODIFICAR EL REGISTRO NECESARIOS
	public function modificarbd()
	{
		$idmarca=$_POST['idmarca'];//se recupera id necesario para cambiar contraseña
		$data['nombre']=$_POST['NAME'];
		
		$this->marca_model->modificarMarca($idmarca,$data);

		redirect('marca/lista','refresh');
	}
	

     //SOFTDELETE DESHABILITAR
     public function deshabilitarbd()
     {
         $idmarca=$_POST['idmarca'];
         $data['estado']=0;//estado es similiar a habilitado 
             
         $this->marca_model->modificarMarca($idmarca,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd
 
         redirect('marca/lista','refresh');
     }
 
     //para ir a ver la lista de deshabilitado o eliminados SOFTDELETE
     public function deshabilitados()
     {
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$lista=$this->marca_model->listaMarcasDeshabi();
				$data['marca']=$lista;
		
		
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaMarca/marcasEliminadas',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else{
				$lista=$this->marca_model->listaMarcasDeshabi();
				$data['marca']=$lista;
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaMarca/marcasEliminadas',$data);//vista de la categoria
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}	
     }
 
     //volver a la lista de habilitados y cambiar estado a 1
     public function habilitarbd()
     {
         $idmarca=$_POST['idmarca'];
         $data['estado']=1;//estado es similiar a habilitado 
         
         $this->marca_model->modificarMarca($idmarca,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd
 
         redirect('marca/deshabilitados','refresh');
     }
     
 
}