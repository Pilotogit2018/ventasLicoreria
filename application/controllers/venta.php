<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {


    public function lista()
    {
        if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	
				$lista = $this->venta_model->listaVentas();
				$data['venta']=$lista;

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaVenta/venta_lista',$data);//vista de la categoria
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$lista=$this->venta_model->listaVentas();
				$data['venta']=$lista;

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaVenta/venta_lista',$data);//vista de la categoria
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
    }

    public function agregarFormulario()
    {
        if($this->session->userdata('login'))
		{
			$tipo = $this->session->userdata('rol');
			if($tipo == 'administrador')
			{	

				$data['clientes']=$this->cliente_model->listaClientes();
				$data['productos']=$this->producto_model->listaProducto();

				$this->load->view('administrador/cuerpoLte/cabecera');
				$this->load->view('administrador/cuerpoLte/menuSuperior');
				$this->load->view('administrador/cuerpoLte/menuLateral');
				$this->load->view('administrador/vistaVenta/formularios/formVenta_agregar',$data);
				$this->load->view('administrador/cuerpoLte/pie');
			}
			else
			{
				$data['clientes']=$this->marca_model->listaMarcas();
				$data['productos']=$this->categoria_model->listaCategoria();

				$this->load->view('empleado/cuerpoLte/cabecera');
				$this->load->view('empleado/cuerpoLte/menuSuperior');
				$this->load->view('empleado/cuerpoLte/menuLateral');
				$this->load->view('empleado/vistaVenta/formularios/formVenta_agregar',$data);
				$this->load->view('empleado/cuerpoLte/pie');
			}
		}
		else
		{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
    }


	public function realizarTransaccionVenta()
	{

		$idCliente = $_POST['cliente'];

		$total = $_POST['total'];

		$detalle_data = $_POST['detalle_data'];
		$idUsuario = $this->session->userdata('idusuario');


		// Llama al modelo para agregar la venta
		$resultado = $this->venta_model->agregarVenta($idCliente, $total, $idUsuario, $detalle_data);

		if ($resultado) {
			$data['venta'] = $this->venta_model->listaVentas();
			$this->load->view('administrador/cuerpoLte/cabecera');
			$this->load->view('administrador/cuerpoLte/menuSuperior');
			$this->load->view('administrador/cuerpoLte/menuLateral');
			$this->load->view('administrador/vistaVenta/venta_lista',$data);
			$this->load->view('administrador/cuerpoLte/pie');
			//$data['contents'] = 'admin/listaventa';
			//$this->load->view('layout/index', $data);
		}
	}

   /* public function index()
    {
        if($this->session->userdata('login'))
		{
			redirect('usuarios/panel','refresh');
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
    }

    public function validarUsuario()
	{
		$login=$_POST['login'];
		$password=md5($_POST['password']);

		$consulta = $this->usuario_model->validar($login, $password);

		if($consulta->num_rows()>0)
		{
			foreach($consulta->result() as $row)
			{
				$this->session->set_userdata('idusuario',$row->idUsuario);
				$this->session->set_userdata('login',$row->nombreUsuario);
				$this->session->set_userdata('rol',$row->rol);
				$this->session->set_userdata('estado',$row->estado);//nuevo
				redirect('usuarios/panel','refresh');
			}
			
		}
		else{
			//en caso de que no sea un usuario no valido se le envia el parametro 1
			redirect('usuarios/index/1','refresh');
		}
	}

    public function panel()
	{

		if($this->session->userdata('estado')=='1')
		{
			
			$tipo = $this->session->userdata('rol');//variable tipo es igual a tipo
			if($tipo =='administrador')//si el tipo es igual a rol
			{
				//redireccionar al usuarios correctamente autentificado
				redirect('inicio/index','refresh');//al controlador categoria metodo indexLte(crear otra vista para que me lleve al dashbord)
			}
			else
			{
				redirect('inicio/index','refresh');//necesario crear otro controlador para empleado y mandar a un metodo
			}
			
		}
		else
		{
			if($this->session->userdata('estado')=='2')
			{
				redirect('usuarios/modificar1','refresh');
			}
			else{
				redirect('usuarios/index/2','refresh');//carga el login en caso de que no haya sesion abierta
			}
		
		}

	}

	//FUNCION MOFIFICAR NECESARIO RECUPERADATOSCATEGORIA
	public function modificar()
	{
		$idusuario=$_POST['idusuario'];
		$data['infousuario']=$this->usuario_model->recuperarusuario($idusuario);
	
		$this->load->view('administrador/cuerpoLte/cabecera');
		$this->load->view('administrador/cuerpoLte/menuSuperior');
		$this->load->view('administrador/cuerpoLte/menuLateral');
		$this->load->view('administrador/vistaUsuario/formularios/modificar_usuario',$data);//vista de la categor
		$this->load->view('administrador/cuerpoLte/pie');
	}

	//FUNCION DE MOODIFICAR EL REGISTRO NECESARIOS
	public function modificarbd()
	{
		$idusuario=$_POST['idusuario'];//se recupera id necesario para cambiar contraseña
		$data['nombre']=$_POST['NAME'];
		$data['primerApellido']=$_POST['apellido1'];//DATA ALmacena los datos y es enviado
		$data['segundoApellido']=$_POST['apellido2'];
		$data['carnetIdentidad']=$_POST['CI'];
		$data['rol']=$_POST['tipo'];
		$data['direccion']=$_POST['mapa'];
		$data['telefono']=$_POST['celular'];
		
		$this->usuario_model->modificarusuario($idusuario,$data);

		redirect('usuarios/listasUsers','refresh');
	}

	//SOFTDELETE DESHABILITAR
    public function deshabilitarbd()
    {
        $idusuario=$_POST['idusuario'];
        $data['estado']=0;//estado es similiar a habilitado 
            
        $this->usuario_model->modificarusuario($idusuario,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd

        redirect('usuarios/listasUsers','refresh');
    }
	
    public function listasUsers()
	{
		if($this->session->userdata('login'))
		{
			$lista=$this->usuario_model->listaUsuario();
			$data['usuario']=$lista;
	
			$this->load->view('administrador/cuerpoLte/cabecera');
			$this->load->view('administrador/cuerpoLte/menuSuperior');
			$this->load->view('administrador/cuerpoLte/menuLateral');
			$this->load->view('administrador/vistaUsuario/lista_usuarios',$data);//vista de la categoria
			$this->load->view('administrador/cuerpoLte/pie');
		}
		else{
			$data['mensaje']=$this->uri->segment(3);//
			$this->load->view('logins/login',$data);//vista del login
		}
	}


    //para ir a ver la lista de deshabilitado o eliminados SOFTDELETE
	public function deshabilitados()
	{
        $lista=$this->usuario_model->listaUsuarioDeshabi();
        $data['usuario']=$lista;


		$this->load->view('administrador/cuerpoLte/cabecera');
		$this->load->view('administrador/cuerpoLte/menuSuperior');
		$this->load->view('administrador/cuerpoLte/menuLateral');
		$this->load->view('administrador/vistaUsuario/usuariosEliminados',$data);//vista de la categoria
		$this->load->view('administrador/cuerpoLte/pie');
	}   

    //volver a la lista de habilitados y cambiar estado a 1
	public function habilitarbd()
	{
		$idusuario=$_POST['idusuario'];
		$data['estado']=1;//estado es similiar a habilitado 
		
		$this->usuario_model->modificarusuario($idusuario,$data);//la funcion modificarcategoria es reutilizada por deshabilitarbd

		redirect('usuarios/deshabilitados','refresh');
	}

    public function logout()
	{
		$this->session->sess_destroy();//mata la variables de session que se crearon
		redirect('usuarios/index/3','refresh');
	}
    */


}