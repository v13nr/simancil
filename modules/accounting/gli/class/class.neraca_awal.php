<?php 
/**
 * v13nr
 *
 * @author     Nanang Rustianto <http://www.jogjaide-enterprise.com> <anangr2001@yahoo.com>
 * @license    Do the right thing
 * @version    1.10
 */



class neraca_awal {
	private $total_aktiva;
	private $total_pasisiva;
	private $lock = 0;
	public $js = "";
	
	public function __construct($ta = 0, $tp = 0){
		$this->total_aktiva = $ta;
		$this->total_pasisiva = $tp;
	}
	private function setTotal_aktiva($ta){
		$this->total_aktiva = $ta;
	}
	private function setTotal_passiva($tp){
		$this->total_passiva = $tp;
	}
	public function getTotal_aktiva(){
		return $this->total_aktiva;
	}
	public function getTotal_passiva(){
		return $this->total_passiva;
	}
	public function setJeson($a){
		$this->js = $a;
	}
	public function getJeson(){
		echo $this->js;
	}
	public function balance($ta, $tp){
		$balance = ($ta == $tp) ? true : false;
		return $balance;
	}
	function hitung_saldo_awal(){
		$cekb = $_POST["cekb"];
		$delimiter="#";
		$itemList = array();
		$itemList = explode($delimiter, $cekb);
		$js = "{";
		for($i=0;$i<count($itemList)-1;$i++)
			{
					$js .= '"'.$itemList[$i]  . '": "'.preg_replace('/[^0-9.]+/', '', $_POST["$itemList[$i]"]).'", ';
					
						$delimitertipe=",";
						$split = explode($delimitertipe, $itemList[$i]);
						$tipe = $split[1];
						if($tipe=="A"){
							$total_tipe_A = $total_tipe_A + preg_replace('/[^0-9.]+/', '', $_POST["$itemList[$i]"]);
						}
						if($tipe=="P"){
							$total_tipe_P = $total_tipe_P + preg_replace('/[^0-9.]+/', '', $_POST["$itemList[$i]"]);
						}
			}
			$js .= ' "0": 0 }';
		
		$this->js = $js;
		$sql = array(); 
		$detail =  json_decode(stripslashes($js)); 
					foreach ($detail as $head=>$value){
						$delimitertipe=",";
						$split = explode($delimitertipe, $head);
						$norek = $split[0];
					  $sql[] = sprintf("UPDATE $database.rekening SET saldoawal =  '%s' WHERE norek = '%s'; ", $value,$norek);
					}
					if ($this->balance($total_tipe_A, $total_tipe_P)==true){
						include "class.connection.php";
						$dbh_awal = new mysql();
						foreach ($sql as $str){
							  $hasil = mysql_query($str);
						  }
					 } 
					  return $this->balance($total_tipe_A, $total_tipe_P);
	}
}

?>