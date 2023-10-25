<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
   
    public function lista()
	{
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$lista=$this->producto_model->listaProducto();
				$data['producto']=$lista;

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaProducto/producto_lista',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$lista=$this->producto_model->listaProducto();
				$data['producto']=$lista;

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaProducto/producto_lista',$data);//vista de la categoria
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
	}

	/*para ir al formulario de agregar 
	public function agregarProvLte()
	{//mostrar formulario para agregar categoria
		$this->load->view('administrador/cuerpoLte/cabecera');
		$this->load->view('administrador/cuerpoLte/menuSuperior');
		$this->load->view('administrador/cuerpoLte/menuLateral');
		$this->load->view('administrador/vistaProducto/formularios/formProducto_agregar');
		$this->load->view('administrador/cuerpoLte/pie');
	}

	//CRUD METODO INSERTAR NECESARIO
	public function agregarbd()
	{  
			//atributo bdd nombre   //formulario=NAME
		$data['nombre']=$_POST['NAME'];
		$data['descripcion']=$_POST['DESCRIPCION'];//DATA ALmacena los datos y es enviado

		$this->categoria_model->agregarCategoria($data);//los datos nombre y descricion de mandan a categoria_model luego al metodo agregarCategoria con variable data
		
		redirect('categoria/index','refresh');
		
	}*/

	public function inscribir()
	{
		if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	

				$data['info1']=$this->marca_model->listaMarcas();
				$data['info3']=$this->categoria_model->listaCategoria();
				$data['info2']=$this->proveedor_model->listaProveedores();

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaProducto/formularios/formProducto_agregar',$data);
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$data['info1']=$this->marca_model->listaMarcas();
				$data['info3']=$this->categoria_model->listaCategoria();
				$data['info2']=$this->proveedor_model->listaProveedores();

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaProducto/formularios/formProducto_agregar',$data);
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else
		{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
	}

	public function incribirInnerbd()
	{
		$data['nombre']=$_POST['NAME'];
		$data['descripcion']=$_POST['DESCRIPCION'];
		$data['cantidad']=$_POST['stock'];
		$data['precioUnitario']=$_POST['unidadPrecio'];

		$idCategoria =$_POST['idCategoria'];
		$idMarca =$_POST['idMarca'];
		$idProveedor =$_POST['idProveedor'];

		$this->producto_model->registrarProducto($idCategoria,$idMarca,$idProveedor,$data);
		redirect('productos/lista','refresh');
	}

	public function modificar()
	{
		
	}
}