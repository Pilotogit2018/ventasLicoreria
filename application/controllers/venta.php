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





	public function reportepdf(){

		$idventas=$_POST['idventa'];
		$listaventacliente=$this->reporte_model->reporteDatosVentaCliente($idventas);
		$listaventacliente=$listaventacliente->result();
		$listaventausuario=$this->reporte_model->reporteDatosVentaUsuario($idventas);
		$listaventausuario=$listaventausuario->result();
		$listadetalleproducto=$this->reporte_model->reporteDatosDetalleProducto($idventas);
		$listadetalleproducto=$listadetalleproducto->result();

		$numero = $idventas;
		$numeroComoCadena = strval($numero);
		//$longitud = strlen($numeroComoCadena);
		if(strlen($numeroComoCadena) < 8){
			$numeroComoCadena = str_pad($numeroComoCadena,8,'0', STR_PAD_LEFT);
		}
		
		//$lista=$this->reporte_model->reporteDatos($idventas);
		//$lista=$lista->result();
		//CAPTURA DE DATOS PARA VENTA Y CLIENTE
		foreach ($listaventacliente as $ventacliente) {
			$idVenta = $ventacliente->idVenta;
			$cliente_razonSocial = $ventacliente->razonSocial;
			$cliente_nit = $ventacliente->ciNit;
			$venta_total = $ventacliente->totalVenta;
			$fecha_venta = $ventacliente->fecha;
		}
		//CAPTURA DE DATOS PARA USUARIO DE LA VENTA
		foreach ($listaventausuario as $ventausuario){
			$usuario = $ventausuario->nombre.' '.$ventausuario->primerApellido;
		}
		//CAPTURA DE DATOS PARA DETALLE DE VENTA Y PRODUCTO
		foreach ($listadetalleproducto as $detalleproducto){
			$producto_nombre = $detalleproducto->nombre;
			$producto_precioUnitario = $detalleproducto->precioUnitario;
			$detalle_cantidad = $detalleproducto->cantidad;
			$detalle_importe = $detalleproducto->importe;
		}

		//generar texto de numeros
		$valor=$venta_total; //almacena el valor puro 
		$parte_entera = floor($valor); //capura de valor entero
		$parte_decimal = $valor - $parte_entera; //captura de decimal

		$fraccion = $parte_decimal."/100";

		$totalpagar=$parte_entera; //MANDAR EL NUMERO TOTAL

		//$totalpagar=48805.00;
		/*
		require_once APPPATH."cifrarAletras/CifrasEnLetras.php";
		$v=new CifrasEnLetras(); 
		//Convertimos el total en letras
		$letra=($v->convertirEurosEnLetras($totalpagar)); 
*/
		$this->pdf=new Pdf(); //creacion de nuevo pdf
		$this->pdf->AddPage(); //agregando una pagina
		$this->pdf->AliasNbPages(); //paginacion
		$this->pdf->SetTitle("COMPROBANTE DE VENTA"); //titulo de reporte
		$this->pdf->SetLeftMargin(15); //margen izquierdo
		$this->pdf->SetRightMargin(15); //margen derecho

		//importar imagenes
		//$ruta=base_url()."img/logos/logomuebleria2.png"; //conocer la ruta de la imagen
		//$this->pdf->Image($ruta, 17, 10, 25, 25); //Rescatar una imagen de la ruta anterior //coordenadas x pixeles //coordenada y pixeles hacia abajo // dimencianes para la imagen ancho y largo
		//configurar el tipo de letra - esto solo es texto
		
		//coordenadas para generar el numero de venta
		$this->pdf->Cell(2); // Ajustar el espacio en blanco si es necesario
		$this->pdf->SetFont('Courier', 'B', 10);
		// Ajustar la coordenada X (posición horizontal)
		$this->pdf->SetXY(165, 10);
		$this->pdf->Cell(89, 3,mb_convert_encoding('N° ','ISO-8859-1', 'UTF-8'), '', 2, 'L', 0);
		$this->pdf->SetFont('Courier', '', 10);
		// Ajustar la coordenada X para el valor de fecha
		$this->pdf->SetXY(180, 10);
		$this->pdf->Cell(89, 3, $numeroComoCadena, '', 2, 'L', 0);

		$this->pdf->SetFont('Courier','B',10); //tipoi de letra, negrilla, tamaño
		$this->pdf->Ln(25);//salto de linea

		//listo para poner contenido - descripcion del negocio - estatico
		
		$this->pdf->Cell(2); //celda en blanco 
		$this->pdf->Cell(89,3,mb_convert_encoding('LICORERIA EL TABERNERO ','ISO-8859-1', 'UTF-8'),'R',2,'L',0); //100 de ancho, 3 de alto, el texto que tendra, margenes, TBLR , Aliniacion de texto a la izquierda L=izquierda | C=centro | R=derecha, 0 sin relleno 1 con relleno
		/*
		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->Cell(89);
		$this->pdf->Cell(89,0,'  Atendido por: ','L',0,'L',0);
		$this->pdf->Ln(3); //Salto de linea
		$this->pdf->Cell(89);
		$this->pdf->SetFont('Courier','B',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(55,0,''.$usuario, 'L',1,'R',0);*/
		
		$this->pdf->Ln(0); //Salto de linea
		
		$this->pdf->SetFont('Courier','B',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(2);
		$this->pdf->Cell(89,3,mb_convert_encoding('Av. AMERICA.','ISO-8859-1', 'UTF-8'),'R',2,'L',0);
		
		$this->pdf->Ln(0);
		
		$this->pdf->Cell(2);
		$this->pdf->Cell(89,3,'Cochabamba - Bolivia','R',2,'L',0);
		$this->pdf->SetFont('Courier','B',10);
		
		$this->pdf->Ln(0);
		
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'Telefono/Celular: ','',0,'L',0);
		$this->pdf->SetFont('Courier','B',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(51,3,'+591 87654321', 'R',1,'L',0);  
		
		//COORDENDAS PARA MOSTRA EL EMPLEADO QUE ATENDIO EN LA VENTA
		$this->pdf->Cell(2); // Ajustar el espacio en blanco si es necesario
		$this->pdf->SetFont('Courier', 'B', 10);
		// Ajustar la coordenada X (posición horizontal)
		$this->pdf->SetXY(110, 40);
		$this->pdf->Cell(89, 3, 'Atendido por: ', '', 2, 'L', 0);
		$this->pdf->SetFont('Courier', '', 10);
		// Ajustar la coordenada X para el valor de fecha
		$this->pdf->SetXY(110, 47);
		//$this->pdf->Cell(89, 0,mb_convert_encoding($usuario,'ISO-8859-1', 'UTF-8'), '', 2, 'L', 0);

		

		$this->pdf->Ln(5);

		$this->pdf->SetDrawColor(23,15,23); //color de margen
		$this->pdf->Cell(180,0,'','B',0,'C',1);

		$this->pdf->Ln(5);
		
		$this->pdf->SetFont('Courier','B',18);
		//$this->pdf->SetFillColor(51,204,51); //color de fondo
		$this->pdf->SetTextColor(0,0,0); //color de texto
		//$this->pdf->SetDrawColor(23,15,23); //color de margen
		$this->pdf->Cell(180,10,'DATOS DEL CLIENTE','',0,'C',0); //ancho, alto, titulo, margen, , Centrado, Relleno

		$this->pdf->Ln(12);

		$this->pdf->SetFont('Courier','B',10);

		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,mb_convert_encoding('Razón Social: ','ISO-8859-1', 'UTF-8'),'',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,mb_convert_encoding($cliente_razonSocial,'ISO-8859-1', 'UTF-8'), '',1,'L',0);

		$this->pdf->Ln(2); //salto de linea

		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'CI / NIT: ','',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,$cliente_nit, '',1,'L',0);

		$this->pdf->Ln(2); //salto de linea

		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'Fecha de Venta: ','',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,$fecha_venta, '',1,'L',0);

		//diseño de tabla
		$this->pdf->Ln(5);
		//60   180
		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->SetFillColor(173, 216, 230);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetDrawColor(0,0,0);
		$this->pdf->Cell(90,5,'PRODUCTO','TBLR',0,'C',1);
		$this->pdf->Cell(22,5,'P/U','TBLR',0,'C',1);
		$this->pdf->Cell(22,5,'CANTIDAD','TBLR',0,'C',1);
		//$this->pdf->Cell(24,5,'DESCUENTO %','TBLR',0,'C',1);
		$this->pdf->Cell(44,5,'IMPORTE','TBLR',0,'C',1);

		$this->pdf->Ln(5);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Courier','B',10);
		
		foreach ($listadetalleproducto as $detalleproducto){
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->Cell(90,5,mb_convert_encoding($detalleproducto->nombre,'ISO-8859-1', 'UTF-8'),'TBLR',0,'L',0);
			//$this->pdf->SetX($this->pdf->GetX() + 90);
			$this->pdf->Cell(22,5,$detalleproducto->precioUnitario,'TBLR',0,'C',0);
			//$this->pdf->SetX($this->pdf->GetX() + 112);
			$this->pdf->Cell(22,5,$detalleproducto->cantidad,'TBLR',0,'C',0);
			//$this->pdf->SetX($this->pdf->GetX() + 134);
			//$this->pdf->SetX($this->pdf->GetX() + 158);
			$this->pdf->Cell(44,5,$detalleproducto->importe,'TBLR',0,'C',0);
			//$this->pdf->SetX($this->pdf->GetX() + 180);
			$this->pdf->Ln(5);
		}
		$this->pdf->Ln(5);
		$this->pdf->Cell(134);
		$this->pdf->Cell(24,5,'TOTAL Bs.','TBLR',0,'C',0);
		$this->pdf->Cell(22,5,$venta_total,'TBLR',0,'C',0);

		$this->pdf->Ln(15);

		$this->pdf->Cell(2); //celda en blanco 
		//$this->pdf->Cell(89,3,strtoupper(mb_convert_encoding('Son: '.$letra.' '.$fraccion.' Bolivianos.')),'',2,'L',0);
		
		$this->pdf->Output("reporte".$idventas.".pdf","I"); //"D" para descargar - "I" para abrir en una nueva ventana
	}

	/*public function reporteRecientepdf(){

            
		$lista=$this->reporte_model->reporteReciente();
		foreach($lista->result() as $row){
			$idventas=$row->idVenta;
		}
		$listaventacliente=$this->reporte_model->reporteDatosVentaCliente($idventas);
		$listaventacliente=$listaventacliente->result();
		$listaventausuario=$this->reporte_model->reporteDatosVentaUsuario($idventas);
		$listaventausuario=$listaventausuario->result();
		$listadetalleproducto=$this->reporte_model->reporteDatosDetalleProducto($idventas);
		$listadetalleproducto=$listadetalleproducto->result();
		
		//$lista=$this->reporte_model->reporteDatos($idventas);
		//$lista=$lista->result();
		//CAPTURA DE DATOS PARA VENTA Y CLIENTE
		foreach ($listaventacliente as $ventacliente) {
			$idVenta = $ventacliente->idCliente;
			$cliente_razonSocial =$ventacliente->razonSocial;
			$cliente_nit = $ventacliente->ciNit;
			$venta_total = $ventacliente->totalVenta;
			$fecha_venta = $ventacliente->fecha;
		}
		//CAPTURA DE DATOS PARA USUARIO DE LA VENTA
		foreach ($listaventausuario as $ventausuario){
			$usuario = $ventausuario->nombre.' '.$ventausuario->primerApellido;
		}
		//CAPTURA DE DATOS PARA DETALLE DE VENTA Y PRODUCTO
		foreach ($listadetalleproducto as $detalleproducto){
			$producto_nombre = $detalleproducto->nombre;
			$producto_precioUnitario = $detalleproducto->precioUnitario;
			$detalle_cantidad = $detalleproducto->cantidad;
			$detalle_descuento = $detalleproducto->descuento;
			$detalle_importe = $detalleproducto->importe;
		}

		//generar texto de numeros
		$valor=$venta_total; //almacena el valor puro 
		$parte_entera = floor($valor); //capura de valor entero
		$parte_decimal = $valor - $parte_entera; //captura de decimal

		$fraccion = $parte_decimal."/100";

		$totalpagar=$parte_entera; //MANDAR EL NUMERO TOTAL

		//$totalpagar=48805.00;
		require_once APPPATH."cifrarAletras/CifrasEnLetras.php";
		$v=new CifrasEnLetras(); 
		//Convertimos el total en letras
		$letra=($v->convertirEurosEnLetras($totalpagar));

		$this->pdf=new Pdf(); //creacion de nuevo pdf
		$this->pdf->AddPage(); //agregando una pagina
		$this->pdf->AliasNbPages(); //paginacion
		$this->pdf->SetTitle("COMPROBANTE DE VENTA"); //titulo de reporte
		$this->pdf->SetLeftMargin(15); //margen izquierdo
		$this->pdf->SetRightMargin(15); //margen derecho

		//importar imagenes
		$ruta=base_url()."img/logos/logomuebleria2.png"; //conocer la ruta de la imagen
		$this->pdf->Image($ruta, 17, 10, 25, 25); //Rescatar una imagen de la ruta anterior //coordenadas x pixeles //coordenada y pixeles hacia abajo // dimencianes para la imagen ancho y largo
		//configurar el tipo de letra - esto solo es texto
		
		//coordenadas para generar el numero de venta
		$this->pdf->Cell(2); // Ajustar el espacio en blanco si es necesario
		$this->pdf->SetFont('Courier', 'B', 10);
		// Ajustar la coordenada X (posición horizontal)
		$this->pdf->SetXY(165, 10);
		$this->pdf->Cell(89, 3,mb_convert_encoding('N° '), '', 2, 'L', 0);
		$this->pdf->SetFont('Courier', '', 10);
		// Ajustar la coordenada X para el valor de fecha
		$this->pdf->SetXY(180, 10);
		$this->pdf->Cell(89, 3, $idventas, '', 2, 'L', 0);

		$this->pdf->SetFont('Courier','B',10); //tipoi de letra, negrilla, tamaño
		$this->pdf->Ln(25);//salto de linea

		//listo para poner contenido - descripcion del negocio - estatico
		
		$this->pdf->Cell(2); //celda en blanco 
		$this->pdf->Cell(89,3,mb_convert_encoding('MUEBLERIA LARA '),'R',2,'L',0); //100 de ancho, 3 de alto, el texto que tendra, margenes, TBLR , Aliniacion de texto a la izquierda L=izquierda | C=centro | R=derecha, 0 sin relleno 1 con relleno
		
		$this->pdf->Ln(0); //Salto de linea
		
		$this->pdf->SetFont('Courier','B',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(2);
		$this->pdf->Cell(89,3,mb_convert_encoding('Av. Beiging entre Av. Tadeo Haenke.'),'R',2,'L',0);
		
		$this->pdf->Ln(0);
		
		$this->pdf->Cell(2);
		$this->pdf->Cell(89,3,'Cochabamba - Bolivia','R',2,'L',0);
		$this->pdf->SetFont('Courier','B',10);
		
		$this->pdf->Ln(0);
		
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'Telefono/Celular: ','',0,'L',0);
		$this->pdf->SetFont('Courier','B',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(51,3,'+591 62701312', 'R',1,'L',0);  
		
		//COORDENDAS PARA MOSTRA EL EMPLEADO QUE ATENDIO EN LA VENTA
		$this->pdf->Cell(2); // Ajustar el espacio en blanco si es necesario
		$this->pdf->SetFont('Courier', 'B', 10);
		// Ajustar la coordenada X (posición horizontal)
		$this->pdf->SetXY(110, 40);
		$this->pdf->Cell(89, 3, 'Atendido por: ', '', 2, 'L', 0);
		$this->pdf->SetFont('Courier', '', 10);
		// Ajustar la coordenada X para el valor de fecha
		$this->pdf->SetXY(110, 47);
		$this->pdf->Cell(89, 0,mb_convert_encoding($usuario), '', 2, 'L', 0);

		

		$this->pdf->Ln(5);

		$this->pdf->SetDrawColor(23,15,23); //color de margen
		$this->pdf->Cell(180,0,'','B',0,'C',1);

		$this->pdf->Ln(5);
		
		$this->pdf->SetFont('Courier','B',18);
		//$this->pdf->SetFillColor(51,204,51); //color de fondo
		$this->pdf->SetTextColor(0,0,0); //color de texto
		//$this->pdf->SetDrawColor(23,15,23); //color de margen
		$this->pdf->Cell(180,10,'DATOS DEL CLIENTE','',0,'C',0); //ancho, alto, titulo, margen, , Centrado, Relleno

		$this->pdf->Ln(12);

		$this->pdf->SetFont('Courier','B',10);

		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,mb_convert_encoding('Razón Social: '),'',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,mb_convert_encoding($cliente_razonSocial), '',1,'L',0);

		$this->pdf->Ln(2); //salto de linea

		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'CI / NIT: ','',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,$cliente_nit, '',1,'L',0);

		$this->pdf->Ln(2); //salto de linea

		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->Ln(0); //interlineado
		$this->pdf->Cell(2);
		$this->pdf->Cell(38,3,'Fecha de Venta: ','',0,'L',0);
		$this->pdf->SetFont('Courier','',9); //letra - sin negrilla - tamaño
		$this->pdf->Cell(52,3,$fecha_venta, '',1,'L',0);

		//diseño de tabla
		$this->pdf->Ln(5);
		//60   180
		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->SetFillColor(238,208,157);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetDrawColor(0,0,0);
		$this->pdf->Cell(90,5,'PRODUCTO','TBLR',0,'C',1);
		$this->pdf->Cell(22,5,'P/U','TBLR',0,'C',1);
		$this->pdf->Cell(22,5,'CANTIDAD','TBLR',0,'C',1);
		//$this->pdf->Cell(24,5,'DESCUENTO %','TBLR',0,'C',1);
		$this->pdf->Cell(22,5,'IMPORTE','TBLR',0,'C',1);

		$this->pdf->Ln(5);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Courier','B',10);
		
		foreach ($listadetalleproducto as $detalleproducto){
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->Cell(90,5,mb_convert_encoding($detalleproducto->nombre),'TBLR',0,'L',0);
			$this->pdf->Cell(22,5,$detalleproducto->precioUnitario,'TBLR',0,'C',0);
			$this->pdf->Cell(22,5,$detalleproducto->cantidad,'TBLR',0,'C',0);
			//$this->pdf->Cell(24,5,$detalleproducto->descuento.'%','TBLR',0,'C',0);
			$this->pdf->Cell(22,5,$detalleproducto->importe,'TBLR',0,'C',0);
			$this->pdf->Ln(5);
		}
		$this->pdf->Ln(5);
		$this->pdf->Cell(134);
		$this->pdf->Cell(24,5,'TOTAL Bs.','TBLR',0,'C',0);
		$this->pdf->Cell(22,5,$venta_total,'TBLR',0,'C',0);

		$this->pdf->Ln(15);

		$this->pdf->Cell(2); //celda en blanco 
		$this->pdf->Cell(89,3,strtoupper(mb_convert_encoding('Son: '.$letra.' '.$fraccion.' Bolivianos.')),'',2,'L',0);
		
		$this->pdf->Output("reporte".$idventas.".pdf","I"); //"D" para descargar - "I" para abrir en una nueva ventana
	}

*/

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