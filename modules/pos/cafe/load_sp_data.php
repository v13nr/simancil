<?php 
	
include "../../core/include/globalx.php";	
include "../include/globalx.php";		

    // proses akan berjalan ketika ada inputan data_type dan parent_id berupa POST
	if(isset($_POST['data_type']) && isset($_POST['parent_id'])){
		$data_type = $_POST['data_type'];
		$parent_id = $_POST['parent_id'];
		/* Custom SQL Query per masing-masing request.
		 * setiap field di beri alias id dan nama agar proses di javascript tidak direpotkan
		 * oleh penamaan field yang berbeda per tiap jenis data.
		 * */
		switch($data_type){
			case 'produk': 
				$sql = "SELECT kodebrg id, namabrg nama FROM $database.stock WHERE status = 1 AND divisi = '$parent_id'"; 				
				$query = mysql_query($sql, $dbh_jogjaide);		
				break;
			case 'subcarabayar': 
				$sql = "SELECT kode id, nama FROM $database.supplier WHERE divisi = '$parent_id'"; 
				$query = mysql_query($sql, $dbh_jogjaide);		
				break;
			case 'carabayar':
			default:
				$sql = "SELECT subdiv id, namadiv nama FROM $database.divisi";				
				$query = mysql_query($sql, $dbh_jogjaide);		
				break;
		}
		$response = array(); // siapkan respon yang nanti akan di convert menjadi JSON
		if($query){
			if(mysql_num_rows($query) > 0){
				while($row = mysql_fetch_object($query)){
					// masukan setiap baris data ke variable respon
					$response[] = $row; 
				}
			}else{
				$response['error'] = 'Data kosong'; // memberi respon ketika data kosong
			}
		}else{
			$response['error'] = ' invalid query : '.mysql_error(); // memberi respon ketika query salah
		}
		die(json_encode($response)); // convert variable respon menjadi JSON, lalu tampilkan 
	}
?>
