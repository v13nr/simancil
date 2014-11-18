<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,10,'People List');
  $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', 'B', 10);
  $pdf->Cell(40,7,'NAMA',1); 
  $pdf->Cell(30,7,'TELEPON',1); 
  $pdf->Cell(120,7,'ALAMAT',1); 
  $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', '', 10);
     
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(40,7,$row->REKANAN_NAMA,1); 
    $pdf->Cell(30,7,$row->REKANAN_TELP,1); 
    $pdf->Cell(120,7,$row->REKANAN_ALAMAT,1); 
    $pdf->Ln();    
  }
  
  $pdf->Output();
?>