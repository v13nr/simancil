var arrowimages = {
	down: ['downarrowclass', IMAGE_PATH + 'arrow-down.gif',25],
	right: ['rightarrowclass', IMAGE_PATH + 'arrow-right.gif']
};
$(document).ready(
  function(){		
	jquerycssmenu.buildmenu("applicationMenu",arrowimages);
	$('.upperCase input').keyup(
		function(){
			$(this).val( String($(this).val()).toUpperCase() );
		}
	);
  }
);
function setupNumber(block,setTotal){
	$(block).focus(function(){
		$(this).val(clearNum($(this).val()));
	});
	$(block).click(function(){
		$(this).val(clearNum($(this).val()));
	});
	$(block).keydown(function(){
		__setupNumber(this);
	});
	$(block).keyup(function(){
		__setupNumber(this);	
	});
	$(block).keypress(function(){
		__setupNumber(this);			
	});
	if(setTotal){
		$(block).blur(function(){
			getTotalTransaction(block);
			$(this).val(formatCurrency($(this).val()));
		});
		$(block).each(function(){
			$(this).val(formatCurrency($(this).val()));
		})
		getTotalTransaction(block);
	}
}
function getTotalTransaction(block){
	/*var total = 0;
	var x = 1;
	$(block).each(function(){
		var dk = $('select[name=dk_'+x+'] option:selected').val();
		//alert(dk);
		if(this.value != '') total += (parseFloat(this.value) * (dk=='debet'?1:-1));
		x++;
	})			
	$('#totalJumlah').val(Math.abs(total));*/
	var x = 1;
	var totalDebet = 0;
	var totalKredit = 0;
	$(block).each(function(){
		var dk = $('select[name=dk_'+x+'] option:selected').val();
		//alert(dk);
		if(this.value != ''){
			if(dk=='debet')
				totalDebet += parseFloat(clearNum(this.value));
			else
				totalKredit += parseFloat(clearNum(this.value));
		}
		x++;
	});
	$('#totalDebet').text(formatCurrency(totalDebet));
	$('#totalKredit').text(formatCurrency(totalKredit));
}
function __setupNumber(input){
	input.value = clearNum(input.value);
	if(isNaN(input.value)){
	   var newStr = '';
	   var str = input.value;
	   for(var x=0;x<str.length;x++){
		 if(isNaN(str.charAt(x)) && str.charAt(x) != '.') continue;
		 newStr += str.charAt(x)   
	   }
	   input.value = newStr;
	}
}
function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num);
}

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}