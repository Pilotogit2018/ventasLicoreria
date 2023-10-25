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
			 $usuario =$rows->login;
 
		 $this->pdf=new Pdf();
		 $this->pdf->AddPage('P','Letter');
		 $this->pdf->AliasNbPages();
		 $this->pdf->SetTitle("Reporte Ventas"); //título en el encabezado
 
		 $this->pdf->SetLeftMargin(20); //margen izquierdo
		 $this->pdf->SetRightMargin(20); //margen derecho
		 $this->pdf->SetFillColor(50,25,56); //color de fondo
		 $this->pdf->SetTextColor(255, 255, 255);
		 $this->pdf->SetFont('Arial', 'B', 11); //tipo de letra
		 $this->pdf->Cell(0,5,'REPORTE DE VENTAS',0,1,'C',1);
		 $this->pdf->Cell(0,5,'Desde: '.formatearSoloFecha($verInicio).' hasta: '.formatearSoloFecha($verFin),0,1,'C',1);
		 $this->pdf->Ln();
		 $this->pdf->Image("uploads/membrete1.png", 147, 21, 50, 50, 'PNG');
		 $this->pdf->SetFont('Arial', 'B', 10);
		 $this->pdf->Ln(8);
 
 
		 $this->pdf->SetTextColor(0,0,0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(20, 5, utf8_decode('Usuario:'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(30, 5, utf8_decode($usuario), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(20, 5, utf8_decode('Direccion:'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(30, 5, utf8_decode('Calle Jordan Nro.152'), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Fecha: ')), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("d/m/Y"))), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Hora: ')), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', '', 9);
		 $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("H:i:s"))), 0, 1, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 9);
		 $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('COCHABAMBA - BOLIVIA')), 0, 0, 'L', 0);
 
		 $this->pdf->Ln(15);//COMO UN MARGEN
		 
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->SetFillColor(86,61,106);
		 $this->pdf->SetTextColor(255, 255, 255);
		 $this->pdf->Cell(175, 10, "Detalle Venta", 1, 1, 'C', 1);
		 $this->pdf->SetFillColor(242, 243, 244);
		 $this->pdf->SetTextColor(0, 0, 0);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(10, 8, 'No.', 'LTRB', 0, 'C', 1);
		 $this->pdf->Cell(65, 8, utf8_decode('Detalle de Producto'), 1, 0, 'C', 1);
		 $this->pdf->Cell(20, 8, utf8_decode('Fecha'), 1, 0, 'C', 1);
		 $this->pdf->Cell(30, 8, utf8_decode('P/U (Bs.)'), 1, 0, 'C', 1);
		 $this->pdf->Cell(20, 8, utf8_decode('Cant.'), 1, 0, 'C', 1);
		 $this->pdf->Cell(30, 8, utf8_decode('Subtotal (Bs.)'), 1, 1, 'C', 1);
 
		 $lista=$this->reporte_model->ventaFechas($verInicio, $verFin);
		 $lista=$lista->result();
		 $num = 1;
		 foreach($lista as $row){
 
			 $descripcion = $row->nombrem.' - '.$row->nombre;
			 $precio = $row->precioVenta;
			 $cantidad = $row->cantidad;
			 $total = $row->precioUnitario;
			 $fecha = $row->fechaRegistro;
 
			 $this->pdf->SetTextColor(0, 0, 0);
			 $this->pdf->SetFont('Arial', '', 8);
			 $this->pdf->Cell(10, 5, $num, 1, 0, 'C', 0);
			 $this->pdf->Cell(65, 5, utf8_decode($descripcion), 1, 0, 'L', false);
			 $this->pdf->Cell(20, 5, utf8_decode( formatearSoloFecha($fecha)), 1, 0, 'C', false);
			 $this->pdf->Cell(30, 5, utf8_decode($precio), 1, 0, 'C', false);
			 $this->pdf->Cell(20, 5, utf8_decode($cantidad), 1, 0, 'C', false);
			 $this->pdf->Cell(30, 5, utf8_decode($total), 1, 0, 'C', false);
			 $this->pdf->Ln();
 
			 $num++;
		 }
		 
		 $this->pdf->Ln(10);
		 $actividad = $this->reporte_model->reporteTotalFechas($verInicio,$verFin);
		 $actividad = $actividad->result();
		 foreach ($actividad as $rows) {
			 $total1 = $rows->total;
		 
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(140, 7, utf8_decode('TOTAL (Bs.):'), 0, 0, 'R', 0);
		 $this->pdf->SetFont('Arial', '', 11);
		 $this->pdf->Cell(25, 7, utf8_decode($total1), 0, 1, 'R', 0);
		 }
			 
		 $this->pdf->Ln(5);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(10, 7, utf8_decode('Son:'), 0, 0, 'L', 0);
		 $this->pdf->SetFont('Arial', 'B', 11);
		 $this->pdf->Cell(40, 7, convertir($total1), 0, 1, 'L', 0);
		 $this->pdf->Output("reporteGeneral.pdf","I");
		 }
 
	 }
 
	  // PDF -> REPORTE GENERAL DE VENTAS
	  public function listapdf()
	  {
  
		  $this->pdf=new Pdf();
		  $this->pdf->AddPage('P','Letter');
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
		  $this->pdf->Image("uploads/membrete1.png", 147, 21, 50, 50, 'PNG');
		  $this->pdf->SetFont('Arial', 'B', 10);
		  $this->pdf->Ln(8);
		  
		  //$actividad = $this->reporte_model->listaventa($_POST['idventa']);
		  //$actividad = $actividad->result();
		  $actividad = $this->venta_model->listaventa();
		  $actividad = $actividad->result();
		  foreach ($actividad as $rows) {
			  $usuario =$rows->login;
		  }
		  $this->pdf->SetTextColor(0,0,0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode('Usuario:'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode($usuario), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode('Direccion:'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode('Calle Jordan Nro.152'), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Fecha: ')), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("d/m/Y"))), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('Hora: ')), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', '', 9);
		  $this->pdf->Cell(30, 5, utf8_decode(utf8_decode(date("H:i:s"))), 0, 1, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 9);
		  $this->pdf->Cell(20, 5, utf8_decode(utf8_decode('COCHABAMBA - BOLIVIA')), 0, 0, 'L', 0);
			  
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
		  $this->pdf->Cell(65, 8, utf8_decode('Detalle de Producto'), 1, 0, 'C', 0);
		  $this->pdf->Cell(20, 8, utf8_decode('Fecha'), 1, 0, 'C', 0);
		  $this->pdf->Cell(30, 8, utf8_decode('P/U (Bs.)'), 1, 0, 'C', 0);
		  $this->pdf->Cell(20, 8, utf8_decode('Cantidad'), 1, 0, 'C', 0);
		  $this->pdf->Cell(30, 8, utf8_decode('Subtotal (Bs.)'), 1, 1, 'C', 0);
  
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
			  $this->pdf->Cell(65, 5, utf8_decode($descripcion), 1, 0, 'L', false);
			  $this->pdf->Cell(20, 5, utf8_decode(formatearSoloFecha($fecha)), 1, 0, 'C', false);
			  $this->pdf->Cell(30, 5, utf8_decode($precio), 1, 0, 'C', false);
			  $this->pdf->Cell(20, 5, utf8_decode($cantidad), 1, 0, 'C', false);
			  $this->pdf->Cell(30, 5, utf8_decode($total), 1, 0, 'C', false);
			  $this->pdf->Ln();
  
			  $num++;
		  }
		  
		  $this->pdf->Ln(10);
		  $actividad = $this->reporte_model->reporteTotal();
		  $actividad = $actividad->result();
		  foreach ($actividad as $rows) {
			  $total1 = $rows->total;
		  
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(140, 7, utf8_decode('TOTAL (Bs.):'), 0, 0, 'R', 0);
		  $this->pdf->SetFont('Arial', '', 11);
		  $this->pdf->Cell(25, 7, utf8_decode($total1), 0, 1, 'R', 0);
		  }
			  
		  $this->pdf->Ln(5);
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(10, 7, utf8_decode('Son:'), 0, 0, 'L', 0);
		  $this->pdf->SetFont('Arial', 'B', 11);
		  $this->pdf->Cell(40, 7, convertir($total1), 0, 1, 'L', 0);
		  $this->pdf->Output("reporteGeneral.pdf","I");
	  }



}