<?
// fungsi-fungsi pendukung.
function minuss($jumlah){
	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),2,'.',',').")";
	}
	else{
		return  number_format($jumlah,2,'.',',');
	}
}

function auto($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00".$nomor;	
		break;
		case "2" :
			return "0".$nomor;	
		break;
		default :
			return $nomor;	
		break;
	}
}
function nobukti($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00000".$nomor;	
		break;
		case "2" :
			return "0000".$nomor;	
		break;
		case "3" :
			return "000".$nomor;	
		break;
		case "4" :
			return "00".$nomor;	
		break;
		case "5" :
			return "0".$nomor;	
		break;
		default :
			return $nomor;	
		break;
	}
}
function absen($tipe) {
	if ($tipe==0) {
		return "Masuk";
	}
	if ($tipe==1) {
		return "Pulang";
	}
	if ($tipe==4) {
		return "Masuk Lembur";
	}
	if ($tipe==5) {
		return "Pulang Lembur";
	}
	
	
}

function getMinggu($tahun, $bulan , $hari) {
       return ceil(($hari + date("w",mktime(0,0,0,$bulan,1,$tahun)))/7);   
   } 
   
function baliktgl($tgl) {
	//21/12/2010
	$hari = substr($tgl,0,2);
	$bln = substr($tgl,3,2);
	$thn = substr($tgl,6,4);
	$tgle = $thn."-".$bln."-".$hari;
	return $tgle;
}

function baliktglindo($tglx) {
	//2010-12-01
	$hari = substr($tglx,8,2);
	$bln = substr($tglx,5,2);
	$thn = substr($tglx,0,4);
	$tgli = $hari."-".$bln."-".$thn;
	return $tgli;
}

function tgl_indo($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan    = getBulan(substr($tgl,5,2));
  $tahun    = substr($tgl,0,4);
  return $tanggal.' '.$bulan.' '.$tahun;        
}    

function getBulan($bln){
  switch ($bln){
	case 1:
	  return "Januari";
	  break;
	case 2:
	  return "Februari";
	  break;
	case 3:
	  return "Maret";
	  break;
	case 4:
	  return "April";
	  break;
	case 5:
	  return "Mei";
	  break;
	case 6:
	  return "Juni";
	  break;
	case 7:
	  return "Juli";
	  break;
	case 8:
	  return "Agustus";
	  break;
	case 9:
	  return "September";
	  break;
	case 10:
	  return "Oktober";
	  break;
	case 11:
	  return "November";
	  break;
	case 12:
	  return "Desember";
	  break;
  }
}
?>