<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
   
    public function lista()
	{
		//AÑADIR AQUI EL LOGIN
		if($this->session->userdata('login'))
		{
			
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$lista=$this->cliente_model->listaClientes();
				$data['cliente']=$lista;

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaCliente/clientes_lista',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$lista=$this->cliente_model->listaClientes();
				$data['cliente']=$lista;

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaCliente/clientes_lista',$data);//vista de la categoria
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
	}

    //para ir al formulario de agregar 
	public function agregarClienteLte()
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
				$this->load->view('administrador/vistaCliente/formularios/formCliente_agregar');
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				//mostrar formulario para agregar categoria
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaCliente/formularios/formCliente_agregar');
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
	{  //atributo bdd nombre   //formulario=NAME
		$data['ciNit']=$_POST['nit'];
        $data['razonSocial']=$_POST['motivo'];

		$this->cliente_model->agregarCliente($data);//los datos nombre y descricion de mandan a categoria_model luego al metodo agregarCategoria con variable data
		
		redirect('cliente/lista','refresh');
	
	}
    

    //FUNCION MOFIFICAR NECESARIO RECUPERADATOSCATEGORIA
	public function modificar()
	{
		if($this->session->userdata('login'))
		{
			
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$idcliente=$_POST['idcliente'];
				$data['infoCliente']=$this->cliente_model->recuperarCliente($idcliente);
			
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaCliente/formularios/modificar_Cliente',$data);//vista de la categor
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$idcliente=$_POST['idcliente'];
				$data['infoCliente']=$this->cliente_model->recuperarCliente($idcliente);
			
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaCliente/formularios/modificar_Cliente',$data);//vista de la categor
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
		$idcliente=$_POST['idcliente'];//se recupera id necesario para cambiar contraseña
        $data['ciNit']=$_POST['nit'];
        $data['razonSocial']=$_POST['motivo'];
		
		$this->cliente_model->modificarCliente($idcliente,$data);

		redirect('cliente/lista','refresh');
	}
	

     //SOFTDELETE DESHABILITAR
     public function deshabilitarbd()
     {
         $idcliente=$_POST['idcliente'];
         $data['estado']=0;//estado es similiar a habilitado 
             
         $this->cliente_model->modificarCliente($idcliente,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd
 
         redirect('cliente/lista','refresh');
     }
 
     //para ir a ver la lista de deshabilitado o eliminados SOFTDELETE
     public function deshabilitados()
     {
		if($this->session->userdata('login'))
		{
			
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$lista=$this->cliente_model->listaClientesDeshabi();
				$data['cliente']=$lista;   
		
				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaCliente/clienteEliminados',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$lista=$this->cliente_model->listaClientesDeshabi();
				$data['cliente']=$lista;   
		
				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaCliente/clienteEliminados',$data);//vista de la categoria
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
         $idcliente=$_POST['idcliente'];
         $data['estado']=1;//estado es similiar a habilitado 
         
         $this->cliente_model->modificarCliente($idcliente,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd
 
         redirect('cliente/deshabilitados','refresh');
     }
     
 
}