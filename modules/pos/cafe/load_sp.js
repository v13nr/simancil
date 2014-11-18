
// JavaScript Document
   /*
   		fungsi loadData akan meng-handle semua request tipe data
   		baik pulau, propinsi atau kabupaten/kota. 
   		parameter kedua dari fungsi ini untuk mengirimkan id dari data parent.
   		contoh: apabila type=propinsi maka parentId digunakan untuk mengambil semua propinsi
   			    dengan id pulau = parentId
   */
   function loadDataCB(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('load_sp_data.php', // request ke file load_data.php
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#combobox_'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#combobox_'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#combobox_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   $(function(){
	   // pertama kali halaman di-load, maka ambil seluruh data pulau 
	   loadDataCB('carabayar',0); 
	   // fungsi yang dipanggil ketika isi dari combobox pulau dipilih 
	   $('#combobox_carabayar').change( 
			function(){
				// apabila nilai pilihan tidak kosong, load data propinsi
				if($('#combobox_carabayar option:selected').val() != '-Pilih data-')
					loadDataCB('subcarabayar',$('#combobox_carabayar option:selected').val());
					loadDataCB('produk',$('#combobox_carabayar option:selected').val());
					nilaix = $('#combobox_carabayar option:selected').val();
					$("#ppk").autocomplete("ajax_auto_barang.php?divisi="+nilaix, {
						width: 300,
						max: 20,
						matchContains: true,
						formatResult: function(row) {
							return row[0];
						}
					});
					$("#ppk").result(function(event, data, formatted) {
						if (data)
							//$(this).parent().next().find("input").val(data[1]);
							//--- plus
							$("#brg").val(data[1]);
							// -----
					});
			}
	   );

   });
