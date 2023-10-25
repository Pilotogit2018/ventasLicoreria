<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    class Pdf extends FPDF {		
		
        public function Header(){
            //si se requiere agregar una imagen
            //$this->Image('ruta de la imagen',coordenada x,coordenada y,ancho,alto);
            //$ruta=base_url("img/membrete2.png");
            //$this->Image($ruta,15,45,190,190);

            $this->SetFont('Arial','B',10);
            $this->Cell(30);
            $this->Cell(120,10,'TITULO CABECERA',0,0,'C');
            $this->Ln('5');
       }

	   public function Footer(){

            //$data=$this->session->userdata('login');
        
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(50,7,utf8_decode('Fecha de impresion: ').utf8_decode(date("d/m/Y")).' - ',0,0,'L',0);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
      }
    }
?>