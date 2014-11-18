function formatNumber(input)
{
	var num = input.value.replace(/\,/g,'');
	if(!isNaN(num)){
	if(num.indexOf('.') > -1){
	num = num.split('.');
	num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'');
	if(num[1].length > 2){
	alert('You may only enter two decimals!');
	num[1] = num[1].substring(0,num[1].length-1);
	} input.value = num[0]+'.'+num[1];
	} else{ input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'') };
	}
	else{ alert('Anda hanya diperbolehkan memasukkan angka!');
	input.value = input.value.substring(0,input.value.length-1);
	}
}
function format_number(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function terbilang(str)
{
	var bilangan = str.replace(/,/g,'');
	bilangan    = String(bilangan);
	var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
      
	var panjang_bilangan = bilangan.length;
      
	/* pengujian panjang bilangan */
	if (panjang_bilangan > 15) {
	  kaLimat = "Diluar Batas";
	  return kaLimat;
	}
      
	/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
	for (i = 1; i <= panjang_bilangan; i++) {
	  angka[i] = bilangan.substr(-(i),1);
	}
      
	i = 1;
	j = 0;
	kaLimat = "";
      
      
	/* mulai proses iterasi terhadap array angka */
	while (i <= panjang_bilangan) {
      
	  subkaLimat = "";
	  kata1 = "";
	  kata2 = "";
	  kata3 = "";
      
	  /* untuk Ratusan */
	  if (angka[i+2] != "0") {
	    if (angka[i+2] == "1") {
	      kata1 = "Seratus";
	    } else {
	      kata1 = kata[angka[i+2]] + " Ratus";
	    }
	  }
      
	  /* untuk Puluhan atau Belasan */
	  if (angka[i+1] != "0") {
	    if (angka[i+1] == "1") {
	      if (angka[i] == "0") {
		kata2 = "Sepuluh";
	      } else if (angka[i] == "1") {
		kata2 = "Sebelas";
	      } else {
		kata2 = kata[angka[i]] + " Belas";
	      }
	    } else {
	      kata2 = kata[angka[i+1]] + " Puluh";
	    }
	  }
      
	  /* untuk Satuan */
	  if (angka[i] != "0") {
	    if (angka[i+1] != "1") {
	      kata3 = kata[angka[i]];
	    }
	  }
      
	  /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
	  if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
	    subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
	  }
      
	  /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
	  kaLimat = subkaLimat + kaLimat;
	  i = i + 3;
	  j = j + 1;
      
	}
      
	/* mengganti Satu Ribu jadi Seribu jika diperlukan */
	if ((angka[5] == "0") && (angka[6] == "0")) {
	  kaLimat = kaLimat.replace("Satu Ribu","Seribu");
	}
	if(kaLimat=='')
	      kaLimat = 'Nol ';
      
	return kaLimat + "Rupiah";
}
function do_scroll(point)
{
	$('html').animate({
		scrollTop: point
	}, 500);
}
function show_notice(msg)
{
	jQuery.noticeAdd({
	      text: msg,
	      stayTime: 5000,   
	      stay: false
	  });
}