
	function nolbulan(x){
		bulan_s = x.toString();
		if(bulan_s.length == 1) { bulan_s = "0" + x; }
		return bulan_s;
		
	}	
	function hitung(){
		
		pembagi = document.getElementById("bagi").value * 1;
		//misal tgl 15-11-2012 jika ditambah 12 bulan maka menjadi 15-11-2013
		
		var tgl_beli = document.getElementById("tgl").value;
		var explode = tgl_beli.split('/');
		var umurhari = explode[0];
		var umurbulan = explode[1] * 1;
		var umurtahun = explode[2] * 1;
		
		if(pembagi == 1){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 1)) + "-" + (umurtahun); }
		if(pembagi == 2){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 2)) + "-" + (umurtahun); }
		if(pembagi == 3){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 3)) + "-" + (umurtahun); }
		if(pembagi == 4){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 4)) + "-" + (umurtahun); }
		if(pembagi == 5){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 5)) + "-" + (umurtahun); }
		if(pembagi == 6){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 6)) + "-" + (umurtahun); }
		if(pembagi == 7){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 7)) + "-" + (umurtahun); }
		if(pembagi == 8){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 8)) + "-" + (umurtahun); }
		if(pembagi == 9){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 9)) + "-" + (umurtahun); }
		if(pembagi == 10){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 10)) + "-" + (umurtahun); }
		if(pembagi == 11){ document.getElementById("tgl_akhir").value = umurhari + "-" + (nolbulan(umurbulan + 11)) + "-" + (umurtahun); }
		if(pembagi == 12){ document.getElementById("tgl_akhir").value = umurhari + "-" + (umurbulan) + "-" + (umurtahun + 1); }
	}