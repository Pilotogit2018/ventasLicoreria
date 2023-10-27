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

        $this->load->view('administrador/cuerpoLte/cabecera');
        $this->load->view('administrador/cuerpoLte/menulateral');
        $this->load->view('administrador/cuerpoLte/menusuperior');
        $this->load->view('administrador/vistaReporte/reportes_generales',$data);
        //$this->load->view('administrador/cuerpoLte/creditos');	
        $this->load->view('administrador/cuerpoLte/pie');
    }
 
	 // REPORTE GENERAL DE VENTAS POR FECHAS
	 public function general_filtrar()
	 {
		 $Inicio=$_POST['inicio'];
		 $data['inicio']=$Inicio;
		 $Fin=$_POST['fin'];
		 $data['fin']=$Fin;
		 $fecha= $this->reporte_model->ventaFechas($Inicio,$Fin);
		 $data['fecha']=$fecha;
 
		 $this->load->view('administrador/cuerpoLte/cabecera');
		 $this->load->view('administrador/cuerpoLte/menulateral');
		 $this->load->view('administrador/cuerpoLte/menusuperior');
		 $this->load->view('administrador/vistaReporte/reportes_generar_filtro',$data);
		 //$this->load->view('administrador/cuerpoLte/creditos');	
		 $this->load->view('administrador/cuerpoLte/pie');
	 }

	 // PDF -> REPORTE GENERAL DE VENTAS POR FECHAS
    
	 public function reporteFechasPdf()
	 {       
		 /*print_r($inicio);
		 print_r($fin);
		 exit;*/
		 if(strlen($_POST['inicio'])>0 and strlen($_POST['fin'])>0){
			 
			 $inicio=$_POST['inicio'];
			 $fin=$_POST['fin'];
			 $verInicio = date('Y/m/d', strtotime($inicio));
			 $verFin = date('Y/m/d', strtotime($fin));
		 }else{
			 $inicio = '1111-01-01';
			 $fin = '9999-12-30';
 
			 $verInicio = '_/_/_';
			 $verFin = '_/_/_';
		 }
 
		 $actividad = $this->reporte_model->ventashistorial();
		 $actividad = $actividad->result();
		 foreach ($actividad as $rows) {
			 $usuario =$rows->nombreUsuario;
 
		 $this->pdf=new Pdf();
		 $this->pdf->AddPage('P','Letter');
		 $this->pdf->AliasNbPages();
		 $this->pdf->SetTitle("Reporte Ventas"); //título en el encabezado
 
		 $this->pdf->SetLeftMargin(20); //margen izquierdo
		 $this->pdf->SetRightMargin(20); //margen derecho
		 $this->pdf->SetFillColor(173, 216, 230); // Color de fondo celeste
		 $this->pdf->SetTextColor(0, 0, 0); // Color de texto (negro)
		 $this->pdf->SetFont('Arial', 'B', 11); //tipo de letra
		 $this->pdf->Cell(0,5,'REPORTE DE VENTAS',0,1,'C',1);
		 //$this->pdf->Cell(0,5,'Desde: '.formatearSoloFecha($verInicio).' hasta: '.formatearSoloFecha($verFin),0,1,'C',1);FECHA
		 $this->pdf->Ln();
		 //$this->pdf->Image("uploads/membrete1.png", 147, 21, 50, 50, 'PNG');
		 $this->pdf->SetFont('Arial', 'B', 10);
		 $this->pdf->Ln(8);
 
 
		 $this->pdf->SetTextColor(0,0,0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(25, 5, mb_convert_encoding('Atendido por: ','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(35, 5, mb_convert_encoding($usuario,'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 //$this->pdf->Cell(20, 5, mb_convert_encoding('Direccion:','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);DIRECCION
		 //$this->pdf->SetFont('Arial', '', 9);
		 //$this->pdf->Cell(30, 5, mb_convert_encoding('Calle Jordan Nro.152','ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(25, 5, mb_convert_encoding(mb_convert_encoding('Fecha: ','ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(35, 5, mb_convert_encoding(mb_convert_encoding(date("d/m/Y"),'ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(25, 5, mb_convert_encoding(mb_convert_encoding('Hora: ','ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(35, 5, mb_convert_encoding(mb_convert_encoding(date("H:i:s"),'ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(25, 5, mb_convert_encoding(mb_convert_encoding('COCHABAMBA - BOLIVIA','ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
 
		 $this->pdf->Ln(15);//COMO UN MARGEN
		 
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->SetFillColor(173, 216, 230);
		 $this->pdf->SetTextColor(0, 0, 0);
		 $this->pdf->Cell(175, 10, "Detalle Venta", 1, 1, 'C', 1);
		 $this->pdf->SetFillColor(242, 243, 244);
		 $this->pdf->SetTextColor(0, 0, 0);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(10, 8, 'No.', 'LTRB', 0, 'C', 1);
		 $this->pdf->Cell(65, 8, mb_convert_encoding('Detalle de Producto','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
		 $this->pdf->Cell(20, 8, mb_convert_encoding('Fecha','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
		 $this->pdf->Cell(30, 8, mb_convert_encoding('P/U (Bs.)','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
		 $this->pdf->Cell(20, 8, mb_convert_encoding('Cant.','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
		 $this->pdf->Cell(30, 8, mb_convert_encoding('Subtotal (Bs.)','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 1);
 
		 $lista=$this->reporte_model->ventaFechas($verInicio, $verFin);
		 $lista=$lista->result();
		 $num = 1;
		 foreach($lista as $row){
 
			 $descripcion = $row->nombrem.' - '.$row->nombre;
			 $precio = $row->precioUnitario;
			 $cantidad = $row->cantidad;	
			 $total = $row->precioUnitario * $row->cantidad;
			 $fecha = $row->fechaRegistro;

			 
 
			 $this->pdf->SetTextColor(0, 0, 0);
			 $this->pdf->SetFont('Arial', '', 8);
			 $this->pdf->Cell(10, 5, $num, 1, 0, 'C', 0);
			 $this->pdf->Cell(65, 5, mb_convert_encoding($descripcion,'ISO-8859-1', 'UTF-8'), 1, 0, 'L', false);
			 $this->pdf->Cell(20, 5, mb_convert_encoding( formatearSoloFecha($fecha),'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			 $this->pdf->Cell(30, 5, mb_convert_encoding($precio,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			 $this->pdf->Cell(20, 5, mb_convert_encoding($cantidad,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			 $this->pdf->Cell(30, 5, mb_convert_encoding($total,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			 $this->pdf->Ln();
 
			 $num++;
		 }
		 
		 $this->pdf->Ln(10);
		 $actividad = $this->reporte_model->reporteTotalFechas($verInicio,$verFin);
		 $actividad = $actividad->result();
		 foreach ($actividad as $rows) {
			 $total1 = $rows->total+$rows->total+$rows->total+$rows->total+$rows->total+$rows->total+$rows->total - 24;
		 
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(140, 7, mb_convert_encoding('TOTAL (Bs.):','ISO-8859-1', 'UTF-8'), 0, 0, 'R', 0);
		 $this->pdf->SetFont('Arial', '', 11);
		 $this->pdf->Cell(25, 7, mb_convert_encoding($total1,'ISO-8859-1', 'UTF-8'), 0, 1, 'R', 0);
		 }
			 
		 $this->pdf->Ln(5);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(10, 7, mb_convert_encoding('Son:','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(40, 7, convertir($total1), 0, 1, 'L', 0);
		 $this->pdf->Output("reporteGeneral.pdf","I");
		 }
 
	 }
 
	  // PDF -> REPORTE GENERAL DE VENTAS
	  public function listapdf()
	  {
		 $this->pdf=new Pdf();
		 $this->pdf->AddPage();
		 $this->pdf->AliasNbPages();
		 $this->pdf->SetTitle("REPORTE");
		 $this->pdf->SetLeftMargin(15);
		 $this->pdf->SetRightMargin(15);
  
		  //$this->pdf=new Pdf();
		  //$this->pdf->AddPage('P','Letter');
		  /* 
		  AddPage:
				  L Orientacion Horizontal
				  P Orientacion Vertical
		  Size: tamaño hoja
				  A3,A4,A5,Letter,Legal
		  */
		  
		  $this->pdf->AliasNbPages();
		  $this->pdf->SetTitle("Reporte General"); //título en el encabezado
  
		  $this->pdf->SetLeftMargin(20); //margen izquierdo
		  $this->pdf->SetRightMargin(20); //margen derecho
		  $this->pdf->SetFillColor(50,25,56); //color de fondo
		  $this->pdf->SetTextColor(255, 255, 255);
		  $this->pdf->SetFont('Arial', 'B', 11); //tipo de letra
		  $this->pdf->Cell(0,10,'REPORTE GENERAL DE VENTAS',0,1,'C',1);
		  //$this->pdf->Cell(0,5,'DE VENTA',0,1,'C',1);
		  $this->pdf->Ln();
		  //$this->pdf->Image("uploads/membrete1.png", 147, 21, 50, 50, 'PNG');
		  $this->pdf->SetFont('Arial', 'B', 10);
		  $this->pdf->Ln(8);
		  
		  //$actividad = $this->reporte_model->listaventa($_POST['idventa']);
		  //$actividad = $actividad->result();
		  $actividad = $this->venta_model->listaVentas();
		  $actividad = $actividad->result();
		  foreach ($actividad as $rows) {
			 $usuario =$rows->login;
		  }
		  $this->pdf->SetTextColor(0,0,0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode('Usuario:','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode($usuario,'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode('Direccion:','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode('Calle Jordan Nro.152','ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Fecha: ','ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("d/m/Y"),'ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Hora: '),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("H:i:s"),'ISO-8859-1', 'UTF-8'),'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('COCHABAMBA - BOLIVIA'),'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
			  
		  //ANCHO/ALTO/TEXTO/BORDE/ORDEN DE LA SIGUIENTE CELDA/ALINEACION=C=CENTER,R=RIGHT,L=LEFT/FILL 0=NO,1=SI/
  
		  //ORDEN DE LA SIGUIENTE CELDA
		  //SI ES 0 = DERECHA
		  //SI ES 1 = SIGUIENTE LINEA
		  //SI ES 2 = DEBAJO
  
		  $this->pdf->Ln(15);//COMO UN MARGEN
		  
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->SetFillColor(86,61,106);
		  $this->pdf->SetTextColor(255, 255, 255);
		  $this->pdf->Cell(175, 10, "Detalle Venta", 1, 1, 'C', 1);
		  $this->pdf->SetTextColor(0, 0, 0); 
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(10, 8, 'Nro.', 'LTRB', 0, 'C', 0);
		  $this->pdf->Cell(65, 8, utf8_decode('Detalle de Producto','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
		  $this->pdf->Cell(20, 8, utf8_decode('Fecha','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
		  $this->pdf->Cell(30, 8, utf8_decode('P/U (Bs.','ISO-8859-1', 'UTF-8)'), 1, 0, 'C', 0);
		  $this->pdf->Cell(20, 8, utf8_decode('Cantidad','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
		  $this->pdf->Cell(30, 8, utf8_decode('Subtotal (Bs.)','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
  
		  $lista=$this->reporte_model->detalle1();
		  $lista=$lista->result();
		  //$actividad = $this->reporte_model->listaventa();
		  //$actividad = $actividad->result();
		  $num = 1;
		  foreach($lista as $row){
  
			  $descripcion = $row->nombrem.' - '.$row->nombre;
			  $fecha = $row->fechaRegistro;
			  $precio = $row->precioVenta;
			  $cantidad = $row->cantidad;
			  $total = $row->precioUnitario;
  
			  $this->pdf->SetFont('Arial', '', 8);
			  $this->pdf->Cell(10, 5, $num, 1, 0, 'C', 0);
			  $this->pdf->Cell(65, 5, utf8_decode($descripcion,'ISO-8859-1', 'UTF-8'), 1, 0, 'L', false);
			  $this->pdf->Cell(20, 5, utf8_decode(formatearSoloFecha($fecha),'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			  $this->pdf->Cell(30, 5, utf8_decode($precio,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			  $this->pdf->Cell(20, 5, utf8_decode($cantidad,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			  $this->pdf->Cell(30, 5, utf8_decode($total,'ISO-8859-1', 'UTF-8'), 1, 0, 'C', false);
			  $this->pdf->Ln();
  
			  $num++;
		  }
		  
		  $this->pdf->Ln(10);
		  $actividad = $this->reporte_model->reporteTotal();
		  $actividad = $actividad->result();
		  foreach ($actividad as $rows) {
			  $total1 = $rows->total;
		  
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(140, 7, utf8_decode('TOTAL (Bs.):','ISO-8859-1', 'UTF-8'), 0, 0, 'R', 0);
		  $this->pdf->SetFont('Arial', '', 11);
		  $this->pdf->Cell(25, 7, utf8_decode($total1,'ISO-8859-1', 'UTF-8'), 0, 1, 'R', 0);
		  }
			  
		  $this->pdf->Ln(5);
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(10, 7, utf8_decode('Son:','ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(40, 7, convertir($total1), 0, 1, 'L', 0);
		  $this->pdf->Ln(15);
		  $this->pdf->Output("reporteGeneral.pdf","I");
	  }



}