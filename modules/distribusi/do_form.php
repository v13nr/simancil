<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Form Pengiriman barang</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {
	font-family: "Perpetua Titling MT";
	font-weight: bold;
}
.style6 {
	color: #FFFFFF;
	font-family: calibri;
	font-weight: bold;
}
.style7 {font-family: calibri}
.style8 {color: #FFFFFF; font-family: calibri; }
.style10 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #FF0000;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript">

var valid = new Object();

    // REGEX

	valid.nama  = /^[a-zA-Z ]*$/;
	
	valid.angka = /^[0-9 ]*$/;
	
	valid.phone = /^[0-9]{12}$/;
	
	valid.email = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3})(\]?)$/;


function test()
{
	var chkJenispaket  = document.form.jenis_paket.value; 
	var chkPaket  = document.form.paket.value; 
	var chkKodePos = document.form.KodePos.value;
	var chkNoHp  = document.form.NoHp.value;
	var chkNoHp_tujuan  = document.form.NoHp_tujuan.value;
	var chkTelpRumah  = document.form.TelpRumah.value;
	
	 
	if (form.jenis_kirim.value<= 0) {
    window.alert("Pilihlah jenis Pengiriman anda!");
    document.form.jenis_kirim.focus();
	return false;
    }
	var jenisPaket = "";
	for (var i=0; i < form.paket.length; i++){
		if (form.paket[i].checked){
			jenisPaket = form.paket[i].value;
		}
	}
	if (jenisPaket == ""){
		window.alert ("Pilih Jenis Paket!");
		return false;
	}
	if(form.ket_paket.value=="") {
		alert ("Isi Keterangan Paket anda!");
		form.ket_paket.focus();
		return false;
	}
	if (form.tujuan.value<= 0) {
    window.alert("Pilihlah tujuan Pengiriman anda!");
    document.form.tujuan.focus();
	return false;
    }
	if(form.Alamat_tujuan.value=="") {
		alert ("Masukan alamat tujuan anda!");
		form.Alamat_tujuan.focus();
		return false;
	}
	if (chkNoHp_tujuan.length <= 0) {
    window.alert("Isi no Hp anda!");
    document.form.NoHp_tujuan.focus();
	return false;
	}
	else if(!(valid.angka.exec(form.NoHp_tujuan.value))){
		window.alert("No hp hanya bisa di isi dengan angka");
		form.NoHp_tujuan.focus();
		form.NoHp_tujuan.select();
		return false;
    }
	if (form.tanggal.value<= 0) {
    window.alert("Pilihlah tanggal pengiriman!");
    document.form.tanggal.focus();
	return false;
    }
	if (form.bulan.value<= 0) {
    window.alert("Pilihlah bulan pengiriman!");
    document.form.bulan.focus();
	return false;
    }
	if (form.tahun.value<= 0) {
    window.alert("Pilihlah tahun pengiriman!");
    document.form.tahun.focus();
	return false;
    }
	if(form.Nama.value=="") {
		alert ("Masukan nama anda dengan lengkap!");
		form.Nama.focus();
		return false;
	}
	// Untuk hanya bisa menerima huruf dan spasi saja.
	else if(!(valid.nama.exec(form.Nama.value))){
		window.alert("Nama harus di isi dengan huruf!!");
		form.Nama.focus();
		form.Nama.select();
		return false;
	}
	if(form.Alamat.value=="") {
		alert ("Masukan alamat anda!");
		form.Alamat.focus();
		return false;
	}
	if (chkKodePos.length <= 0) {
    window.alert("Isi Kodepos anda!");
    document.form.KodePos.focus();
	return false;
	}
	else if(!(valid.angka.exec(form.KodePos.value))){
		window.alert("Kode Pos harus di isi dengan angka");
		form.KodePos.focus();
		form.KodePos.select();
		return false;
	}
	if (chkTelpRumah.length <= 0) {
    window.alert("Isi no Telp Rumah atau Telp Kantor anda!");
    document.form.TelpRumah.focus();
	return false;
	}
	else if(!(valid.angka.exec(form.TelpRumah.value))){
		window.alert("No Telp hanya bisa di isi dengan angka");
		form.TelpRumah.focus();
		form.TelpRumah.select();
		return false;
    }
	if (chkNoHp.length <= 0) {
    window.alert("Isi no Hp anda!");
    document.form.NoHp.focus();
	return false;
	}
	else if(!(valid.angka.exec(form.NoHp.value))){
		window.alert("No hp hanya bisa di isi dengan angka");
		form.NoHp.focus();
		form.NoHp.select();
		return false;
    }
	if (form.email.value=="") {
		window.alert ("Masukan alamat E-mail anda!");
		form.email.focus();
		return false;
	}
	// Untuk hanya bisa menerima input dengan format email yang benar.
	else if(!(valid.email.exec(form.email.value))){
		window.alert ("E-mail tidak Valid!!!!");
		form.email.focus();
		form.email.select();
		return false;
	}
	/*
	else
    {
        document.form.submit();
		window.alert("Terimakasih bwat komentar na BRODER !");
		return true;
    }*/
}

		</script>
<style>false{visibility: hidden;}</style><script name="adpolicy-script" type="text/javascript">//<![CDATA[ 

 

;if(typeof ctaJSON!=='object'){ctaJSON={}}(function(){'use strict';function f(n){return n<10?'0'+n:n}/*if(typeof Date.prototype.toctaJSON!=='function'){Date.prototype.toctaJSON=function(a){return isFinite(this.valueOf())?this.getUTCFullYear()+'-'+f(this.getUTCMonth()+1)+'-'+f(this.getUTCDate())+'T'+f(this.getUTCHours())+':'+f(this.getUTCMinutes())+':'+f(this.getUTCSeconds())+'Z':null};String.prototype.toctaJSON=Number.prototype.toctaJSON=Boolean.prototype.toctaJSON=function(a){return this.valueOf()}}*/var e=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},rep;function quote(b){escapable.lastIndex=0;return escapable.test(b)?'"'+b.replace(escapable,function(a){var c=meta[a];return typeof c==='string'?c:'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+b+'"'}function str(a,b){var i,k,v,length,mind=gap,partial,value=b[a];if( value && typeof value==='object') {if(value instanceof Date) {value = isFinite(value.valueOf())?value.getUTCFullYear()+'-'+f(value.getUTCMonth()+1)+'-'+f(value.getUTCDate())+'T'+f(value.getUTCHours())+':'+f(value.getUTCMinutes())+':'+f(value.getUTCSeconds())+'Z':null;}else if(value instanceof String || value instanceof Number || value instanceof Boolean) {value = value.valueOf();}/*value=value.toctaJSON(a)*/}if(typeof rep==='function'){value=rep.call(b,a,value)}switch(typeof value){case'string':return quote(value);case'number':return isFinite(value)?String(value):'null';case'boolean':case'null':return String(value);case'object':if(!value){return'null'}gap+=indent;partial=[];if(Object.prototype.toString.apply(value)==='[object Array]'){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||'null'}v=partial.length===0?'[]':gap?'[\n'+gap+partial.join(',\n'+gap)+'\n'+mind+']':'['+partial.join(',')+']';gap=mind;return v}if(rep&&typeof rep==='object'){length=rep.length;for(i=0;i<length;i+=1){if(typeof rep[i]==='string'){k=rep[i];v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v)}}}}else{for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v)}}}}v=partial.length===0?'{}':gap?'{\n'+gap+partial.join(',\n'+gap)+'\n'+mind+'}':'{'+partial.join(',')+'}';gap=mind;return v}}if(typeof ctaJSON.stringify!=='function'){ctaJSON.stringify=function(a,b,c){var i;gap='';indent='';if(typeof c==='number'){for(i=0;i<c;i+=1){indent+=' '}}else if(typeof c==='string'){indent=c}rep=b;if(b&&typeof b!=='function'&&(typeof b!=='object'||typeof b.length!=='number')){throw new Error('ctaJSON.stringify');}return str('',{'':a})}}if(typeof ctaJSON.parse!=='function'){ctaJSON.parse=function(c,d){var j;function walk(a,b){var k,v,value=a[b];if(value&&typeof value==='object'){for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v}else{delete value[k]}}}}return d.call(a,b,value)}c=String(c);e.lastIndex=0;if(e.test(c)){c=c.replace(e,function(a){return'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4)})}if(/^[\],:{}\s]*$/.test(c.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,''))){j=eval('('+c+')');return typeof d==='function'?walk({'':j},''):j}throw new SyntaxError('ctaJSON.parse');}}}());

var cta_linr = {};
cta_linr.innerFunctions = {};
cta_linr.instances = {};

cta_linr.regInstance = function(ev, params) {
    
    var key = ev.origin + '_' + (Math.random()*10000000);
    
    cta_linr.instances[key] = {
        source: ev.source,
        origin: ev.origin
    };
};

/**
* Ugly workaround for IE document.getElementsByName() function
* FIXME: any updates are welcome
*/
cta_linr.innerFunctions.getElementsByAttribute = function (oElm, strTagName, strAttributeName, strAttributeValue) {
    
    if(!oElm) {
        oElm = document;
    }
    
    var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    var oAttributeValue = (typeof strAttributeValue != "undefined")? new RegExp("(^|\\s)" + strAttributeValue + "(\\s|$)", "i") : null;
    var oCurrent;
    var oAttribute;
        
    for(var i = 0; i < arrElements.length; i ++) {
        
        oCurrent = arrElements[i];
        oAttribute = oCurrent.getAttribute && oCurrent.getAttribute(strAttributeName);
        
        if(typeof oAttribute == "string" && oAttribute.length > 0) {
            
            if(typeof strAttributeValue == "undefined" || (oAttributeValue && oAttributeValue.test(oAttribute))){
                arrReturnElements.push(oCurrent);
            }
        }
    }
    
    return arrReturnElements;
};


cta_linr.getContentType = function() {
    
    var contentRules = {};
    contentRules.adult = [
        //(big|cyber|hard|huge|mega|small|soft|super|tiny|bare|naked|nude|anal|oral|topp?les|sex|phone|porn|){1,}.*(anal|babe|bharath|boob|breast|busen|busty|clit|cum|cunt|dick|fetish|fuck|girl|hooter|lez|lust|naked|nude|oral|orgy|penis|porn|porno|pupper|pussy|rotten|sex|shit|smutpump|teen|tit|topp?les|xxx){1,}/i,
        //(anal|babe|bharath|boob|breast|busen|busty|clit|cum|cunt|dick|fetish|fuck|girl|hooter|lez|lust|naked|nude|oral|orgy|penis|porn|porno|pupper|pussy|rotten|sex|shit|smutpump|teen|tit|topp?les|xxx){1,}.*(big|cyber|hard|huge|mega|small|soft|super|tiny|bare|naked|nude|anal|oral|topp?les|sex|pussy){1,}/i,
        //(adultsight|adultsite|adultsonly|adultweb|blowjob|bondage|centerfold|cumshot|cyberlust|cybercore|hardcore|masturbat|bangbros|pussylip|playmate|pornstar|sexdream|showgirl|softcore|striptease)/i
        
        /(big|hard|dirty|sexy|hottest|naked|adult|hardcore|transexual|lesbian|asian|latina|ebony|amateur|milf|mature|teen|voyeur|group|pregnant|interracial|vintage){1,}.*(porn|xxx|sex|pussy|fetish|tits|dick|cunt|fuck|masturbat|fisting|boobs|butt|cock|suck|vagina|dildo|blowjob|whore|bbw|cfnm|bdsm|pornstar|gay|cumshot|penis|hentai|gangbang|cunnilingus|gonzo|fingering|bebe|girl){1,}/gi,
        /(nude|porn|xxx| pussy | fetish | tits | dick | cunt | fuck| masturbat| fisting | boobs | cock | suck| vagina | dildo | blowjob | whore | bbw | cfnm | bdsm | pornstar | gay | cumshot| penis | hentai | gangbang | cunnilingus | gonzo| fingering | transexual | lesbian | ass )/gi
    ];
    
    var metaTypes = {'title':true, 'keywords':true, 'description':true};
    var metaTags = {};
    
    var tmp = document.getElementsByTagName('meta');
    for(var i in tmp) {
        
        var metaTag = tmp[i];
        try {
            if((metaTag.name.toLowerCase() in metaTypes)) {
                metaTags[metaTag.name] = metaTag.getAttribute('content') || metaTag.getAttribute('value');
            }
        }catch(e){}
    }
    
    var titleEl = document.getElementsByTagName('title');
    if(titleEl) {
        metaTags.title = titleEl[0].innerHTML;
    }
    for(var type in contentRules) {
        
        var rules = contentRules[type];
        for(var ruleKey in rules) {
            var rule = rules[ruleKey];
            for(var metaKey in metaTags) {
                
                try {
                    
                    var metaTag = metaTags[metaKey];
                    if(found = rule.exec(metaTag)) {
                        return type;
                    }
                }
                catch(e) {}
            }
        }
    }
    
    return 'clean';
}

cta_linr.closeAllAds = function(ev, params) { 
    
    var evnt;
    for(var i = 0 in cta_linr.instances) {
        
        evnt = cta_linr.instances[i];
        var m = ctaJSON.stringify({command: "closeSelf", params: {}});
        evnt.source.postMessage(m, evnt.origin);
    }
    
    var divs = cta_linr.innerFunctions.getElementsByAttribute(document, '*', 'name', 'cta_divforc');
    for(var i = 0; i < divs.length; i++) { 
        
        var div = divs[i]; 
        var dims = cta_linr.innerFunctions.getElementSize(div.getElementsByTagName('div')[0] || div);
        
        if(typeof dims != 'undefined') {
            
            div.style.width = parseInt(dims.width) + "px";
            div.style.height = parseInt(dims.height) + "px";
        }
        
        div.id = '';
        div.innerHTML = "";
    }
    
    var iframes = cta_linr.innerFunctions.getElementsByAttribute(document, 'iframe', 'name', 'cta_iframeforc');
    for(var i = 0; i < iframes.length; i++) {
        
        var iframe = iframes[i];
        var dims = cta_linr.innerFunctions.getElementSize(iframe);
        
        var p = iframe.parentNode;
        var div = document.createElement("div");
        div.style.width = parseInt(dims.width) + "px";
        div.style.height = parseInt(dims.height) + "px";
        div.style.display = "block";
        p.insertBefore(div, iframe);
        p.removeChild(iframe);
    }
    
    var imgs = document.getElementsByName('test-img');
    for(var i = 0; i < imgs.length; i++) {
        var img = imgs[i];
        img.style.display="none";
    }
};


/**
 * Function works incorrect, because i do not know how get 
 * background color if it is image from css class
 * */
cta_linr.innerFunctions.getReverseColor = function (oEl) {
    
    var backgroundColor = 'FFFFFF', color = {r: 255, g: 255, b: 255, a: 1}, reverse = {r: 0, g: 0, b: 0, a: 0};
    
    if(typeof oEl == 'undefined') {
        return color;
    }
    
    do {        
        if (oEl.currentStyle) {
            var bc = oEl.currentStyle['backgroundColor'];
        } else if (window.getComputedStyle) {
            var bc = document.defaultView.getComputedStyle(oEl,null).getPropertyValue('background-color');
        }
        
        if(bc && bc != 'transparent' && bc != 'rgba(0, 0, 0, 0)') {
            backgroundColor = bc;
            break;
        }
        
    } while(oEl = oEl.parentNode);
    
    if(/^rgb/.test(backgroundColor)) {
        
        t = backgroundColor.match(/(\d{1,})/g);
        color.r = t[0]; color.g = t[1]; color.b = t[2];
        
        if(t.length > 3) {
            color.a = t[3];
        }
    }
    else if(backgroundColor.length == 3){
        
        t = backgroundColor.match(/(.)/g);
        color.r = parseInt(t[0], 16); color.g = parseInt(t[1], 16); color.b = parseInt(t[2], 16);
    }
    else if(backgroundColor.length == 6){
        
        t = backgroundColor.match(/(.{2})/g);
        color.r = parseInt(t[0], 16); color.g = parseInt(t[1], 16); color.b = parseInt(t[2], 16);
    }
    reverse.r = 255 - color.r; reverse.g = 255 - color.g; reverse.b = 255 - color.b; reverse.a = 1 - color.a;
    return reverse;
}

cta_linr.innerFunctions.getElementSize = function(element) {
    
    var dims = {height:0, width:0};
    
    if(typeof element != 'undefined') {
        
        if (typeof element.style != 'undefined' && element.style.height) {
            dims.height = element.style.height;
        }
        else if (element.innerHeight) {
            dims.height = element.innerHeight;
        }
        else if (element.clientHeight) {
            dims.height = element.clientHeight;
        }
        
        if (typeof element.style != 'undefined' && element.style.width) {
            dims.width = element.style.width;
            
        }
        else if (element.innerWidth) {
            dims.width = element.innerWidth;
            
        }
        else if (element.clientWidth) {
            dims.width = element.clientWidth;
        }
    }
    
    return dims;
};

cta_linr.innerFunctions.findElPos = function(obj, usePos) {

    var offleft = offtop = 0;
    if (typeof obj != 'undefined' && obj.offsetParent) {
        do {

            if(usePos && (obj.style.position == 'absolute' || obj.style.position == 'relative')) {
                break;
            }

            offleft += obj.offsetLeft;
            offtop += obj.offsetTop;

        } while (obj = obj.offsetParent);
    }

    return {offleft: offleft, offtop: offtop};
};


cta_linr.getAdditionalParams = function(ev, params) {
    
    params.params.params.cType = cta_linr.getContentType();
    cta_linr.getClientHeight(ev,params);
    
}

cta_linr.getClientHeight = function(ev, params) {
    
    var cHeight = 0;
    
    if (window.innerHeight) {
        cHeight = window.innerHeight;
    }
    else if (document.documentElement && document.documentElement.clientHeight) {
        cHeight = document.documentElement.clientHeight;
    }
    else if (document.body) {
        cHeight = document.body.clientHeight;
    }
    
    var data = {clientHeight: cHeight, offsetTop: 0, params: params.params.params};
    
    var ur = /^http[s]?\:\/\/(www\.)?/i;
    var ifrs = document.getElementsByTagName("iframe");
    
    for(var i = 0; i < ifrs.length; i++) {
        try {
            var iframe = ifrs[i];
            pos = cta_linr.innerFunctions.findElPos(iframe);            
            if(iframe.src.toLowerCase().replace(ur, '') == params.params.referrer.toLowerCase().replace(ur, '')) {
                data.offsetTop = pos.offtop;
                ev.source.postMessage(ctaJSON.stringify({command: "setFoldIfIsItYour", params: data}), '*');
            }
            else {
                data.offsetTop = pos.offtop;
                iframe.contentWindow.postMessage(ctaJSON.stringify({command: "setFoldIfIsItYour", params: data}), '*');
            }
        } 
        catch (ex) {}        
    }
    
    var frs = document.getElementsByTagName("frame");
    for(var i = 0; i < frs.length; i++) {
        
        var frame = frs[i];
        pos = cta_linr.innerFunctions.findElPos(frame);
        
        if(frame.src.toLowerCase().replace(ur, '') == params.params.referrer.toLowerCase().replace(ur, '')) {
            // for frames we think that position is below because frames can be very largest and has many ads 
            data.offsetTop = data.clientHeight*1 + params.params.params.height*1;
            ev.source.postMessage(ctaJSON.stringify({command: "setFoldIfIsItYour", params: data}), '*');
        }
        else {
            data.offsetTop = pos.offtop;
            frame.contentWindow.postMessage(ctaJSON.stringify({command: "setFoldIfIsItYour", params: data}), '*');
        }
    }
    
    // if we do not found our frame we think that position is below because frames can be very largest and has many ads 
    data.offsetTop = data.clientHeight*1 + params.params.params.height*1;
    ev.source.postMessage(ctaJSON.stringify({command: "setFoldIfIsItYour", params: data}), '*');
    
    return data;
};

cta_linr.callOuterFunction = function(ev, params) {
    
    if(window[params.params.func] != undefined && typeof window[params.params.func] == "function") {
        try{
            window[params.params.func].apply(window, params.params.arguments);
        }
        catch(e){console.log("CATCH", e)}
    }
};

cta_linr.listn = function(ev) {
    try {
        var params = ctaJSON.parse(ev.data);
        
        if( typeof params.command != "undefined"
            && (typeof cta_linr[params.command] == "function")) {
            
            var data = cta_linr[params.command](ev, params);
            if(params.params != undefined && params.params.callback != undefined) {
                ev.source.postMessage(ctaJSON.stringify({callback: params.params.callback, data: data}), ev.origin);
            }
        }
    }
    catch(ex) {}
};

// Workaround for IEs ...................
function addTAEvent(evnt, elem, func) {
    if (elem.addEventListener)  // W3C DOM
         elem.addEventListener(evnt,func,false);
    else if (elem.attachEvent) { // IE DOM
        elem.attachEvent("on"+evnt, func);
    }
    else { // No much to do
    elem[evnt] = func;
     }
}

addTAEvent('message', window, cta_linr.listn);

//]]></script></head>

<body>
<form onsubmit="return test()" id="form" method="post" name="form" action="emailer2.php">
<p class="style3" align="center">Form ORder Pengiriman Barang/dokumen</p>
<table align="center" border="0" cellpadding="2" cellspacing="2" width="570">
    <tbody>
      <tr align="center" bgcolor="#ded3f7">
        <td colspan="2" class="AllText" bgcolor="#186297" height="36"><span class="style6">Order Pengiriman Barang/dokumen</span></td>
      </tr>
      <tr>
        <td class="AllText style7" align="left" bgcolor="#fff7ef" width="253">Jenis Pengiriman : </td>
        <td bgcolor="#CCCCCC" valign="top" width="303">
		  <span class="style7">
		  <select name="jenis_kirim" id="jenis_kirim">
		    <option value="0">Pilih Jenis Pengiriman</option>
		    <option value="Darat">Darat/City Courier</option>
		    <option value="Udara">Udara</option>
		    <option selected="selected" value="Laut">Laut</option>
	      </select>
        <span class="style1">* </span></span> </td>
      </tr>
      <tr>
        <td class="style23 style7" bgcolor="#fff7ef" height="26" valign="top">  Nama Paket : </td>
        <td bgcolor="#CCCCCC" valign="top"><p class="style7">
          <input name="paket" value="Barang" type="radio">
          Barang.&nbsp;
            <input name="paket" value="Dokumen" type="radio">
          Dokumen.
          <br><input checked="checked" name="paket" value="Lain-lain" type="radio">
            lain-lain.
            <input name="jenis_paket" id="jenis_paket" size="20" maxlength="100" type="text">
            <span class="style1">*</span></p>
        </td>
      </tr>
      <tr>
        <td class="style23 style7" bgcolor="#fff7ef" height="26" valign="top">Ket Paket Pengiriman :</td>
        <td bgcolor="#CCCCCC" valign="top"><textarea name="ket_paket" cols="35" rows="3" id="ket_paket"></textarea>
        <span class="style1">*</span></td>
      </tr>
      <tr bgcolor="#fff7ef">
        <td class="style23 style7" align="left"> Tujuan pengiriman :</td>
        <td bgcolor="#CCCCCC" valign="top"><span class="style8">
          <label></label>
        </span> <span class="style7"><span class="style1">
<select name="tujuan" id="tujuan">
  <option value="0">Pilih Tujuan Pengiriman</option>
  <option value="AMBON ">AMBON </option>
  <option selected="selected" value="BALIKPAPAN ">BALIKPAPAN </option>
  <option value="BANDA ACEH ">BANDA ACEH </option>
  <option value="BANDAR LAMPUNG ">BANDAR LAMPUNG </option>
  <option value="BANDUNG ">BANDUNG </option>
  <option value="BANJARMASIN ">BANJARMASIN </option>
  <option value="BANYUWANGI ">BANYUWANGI </option>
  <option value="BATAM ">BATAM </option>
  <option value="BENGKULU ">BENGKULU </option>
  <option value="BEKASI">BEKASI</option>
  <option value="BIAK ">BIAK </option>
  <option value="BONTANG ">BONTANG </option>
  <option value="Bogor">Bogor</option>
  <option value="CILACAP ">CILACAP </option>
  <option value="CIREBON ">CIREBON </option>
  <option value="DENPASAR ">DENPASAR </option>
  <option value="DEPOK">DEPOK</option>
  <option value="GARUT ">GARUT </option>
  <option value="GORONTALO ">GORONTALO </option>
  <option value="Jakarta">Jakarta</option>
  <option value="JAMBI ">JAMBI </option>
  <option value="JAYAPURA ">JAYAPURA </option>
  <option value="JEMBER ">JEMBER </option>
  <option value="KARAWANG ">KARAWANG </option>
  <option value="KENDARI ">KENDARI </option>
  <option value="KUDUS ">KUDUS </option>
  <option value="KUPANG ">KUPANG </option>
  <option value="MADIUN ">MADIUN </option>
  <option value="MAKASSAR ">MAKASSAR </option>
  <option value="MALANG ">MALANG </option>
  <option value="MANADO ">MANADO </option>
  <option value="MATARAM ">MATARAM </option>
  <option value="Medan ">Medan </option>
  <option value="PADANG ">PADANG </option>
  <option value="PAKANBARU ">PAKANBARU </option>
  <option value="PALANGKARAYA ">PALANGKARAYA </option>
  <option value="PALEMBANG ">PALEMBANG </option>
  <option value="PANGKAL PINANG ">PANGKAL PINANG </option>
  <option value="PEKALONGAN ">PEKALONGAN </option>
  <option value="PONTIANAK ">PONTIANAK </option>
  <option value="PURWOKERTO">PURWOKERTO </option>
  <option value="SALATIGA ">SALATIGA </option>
  <option value="SAMARINDA ">SAMARINDA </option>
  <option value="SEMARANG ">SEMARANG </option>
  <option value="SERANG ">SERANG </option>
  <option value="SOLO ">SOLO </option>
  <option value="SORONG ">SORONG </option>
  <option value="SUKABUMI ">SUKABUMI </option>
  <option value="SURABAYA ">SURABAYA </option>
  <option value="TANGERANG">TANGERANG</option>
  <option value="TARAKAN ">TARAKAN </option>
  <option value="TASIKMALAYA ">TASIKMALAYA </option>
  <option value="TEGAL ">TEGAL </option>
  <option value="TERNATE ">TERNATE </option>
  <option value="YOGYAKARTA ">YOGYAKARTA </option>
</select>
* </span></span></td>
      </tr>
      <tr bgcolor="#fff7ef">
         <td align="left" bgcolor="#fff7ef" valign="top"><span class="style7">Alamat Tujuan : </span></td>
         <td bgcolor="#CCCCCC" valign="top"><textarea name="Alamat_tujuan" cols="30" rows="3" id="Alamat_tujuan"></textarea>
         <span class="style1">*</span></td>
      </tr>
      <tr bgcolor="#fff7ef">
        <td align="left" bgcolor="#fff7ef" valign="top"><span class="style7">No. Telp. Rumah/Kantor Tujuan :</span></td>
        <td bgcolor="#CCCCCC" valign="top"><input name="TelpRumah_tujuan" id="TelpRumah_tujuan" size="20" maxlength="100" type="text">
        /
        <input name="TelpKantor_tujuan" id="TelpKantor_tujuan" size="20" maxlength="100" type="text"></td>
      </tr>
      <tr bgcolor="#fff7ef">
        <td align="left" bgcolor="#fff7ef" valign="top"><span class="style7">No. Handphone Tujuan :</span></td>
        <td bgcolor="#CCCCCC" valign="top"><span class="style7">
          <input name="NoHp_tujuan" id="NoHp_tujuan" size="40" maxlength="100" type="text">
          <span class="style1">*</span></span></td>
      </tr>
      <tr bgcolor="#fff7ef">
        <td class="style23 style7" align="left" bgcolor="#fff7ef"> Tanggal Pengiriman : </td>
        <td bgcolor="#CCCCCC" valign="top"><span class="style7">
          <select name="tanggal" id="tanggal">
            <option value="0" selected="selected">Tgl</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select>
            <select name="bulan" id="bulan">
              <option value="0" selected="selected">Bulan</option>
              <option value="Januari">Januari</option>
              <option value="Februari">Februari</option>
              <option value="Maret">Maret</option>
              <option value="April">April</option>
              <option value="Mei">Mei</option>
              <option value="Juni">Juni</option>
              <option value="Juli">Juli</option>
              <option value="Agustus">Agustus</option>
              <option value="September">September</option>
              <option value="Oktober">Oktober</option>
              <option value="November">November</option>
              <option value="Desember">Desember</option>
              </select>
            <select name="tahun" id="tahun">
              <option value="0" selected="selected">Tahun</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              </select>
            <span class="style1">*</span></span> </td>
      </tr>
      <tr align="center" bgcolor="#ded3f7">
        <td colspan="2" class="style15 style8 AllText" bgcolor="#186297" height="27"><span class="style16 style1 style7"><strong>Informasi Calon Pengirim</strong></span></td>
      </tr>
      <tr bgcolor="#fff7ef">
        <td class="style23 style7" align="left" bgcolor="#fff7ef" height="26" valign="top"> Nama Lengkap : </td>
        <td bgcolor="#CCCCCC" valign="top"><span class="style7">
          <input name="Nama" id="Nama" size="40" maxlength="100" type="text">
        <span class="style1">*</span></span></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef" valign="top"><span class="style7">Alamat : </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><span class="style7">
          <label>
          <textarea name="Alamat" cols="35" rows="3" id="Alamat"></textarea>
          </label>
          <span class="style1">*</span></span></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef"><span class="style7">Kode Pos : </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><span class="style7">
          <input name="KodePos" id="KodePos" size="15" type="text">
          <span class="style1">*</span></span> </td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef"><span class="style7">No. Telp. Rumah/Kantor : </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><input name="TelpRumah" id="TelpRumah" size="20" maxlength="100" type="text">
        <span class="style1">/
        <input name="TelpKantor" id="TelpKantor" size="20" maxlength="100" type="text">
        *</span></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef"><span class="style7">No. Handphone </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><span class="style7">
          <input name="NoHp" id="NoHp" size="40" maxlength="100" type="text">
          <span class="style1">*</span></span></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef"><span class="style7">e-mail : </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><span class="style7">
          <input name="email" id="email" size="40" type="text">
          <span class="style1">* </span></span></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#fff7ef" valign="top"><span class="style7">Pesan Lain : </span></td>
        <td align="left" bgcolor="#CCCCCC" valign="top"><span class="style7">
          <textarea name="PesanLain" cols="38" rows="3" id="PesanLain"></textarea>
        </span> </td>
      </tr>
      <tr align="left">
        <td colspan="2" bgcolor="#186297"><div class="style7" align="center">
          <input name="submit" value="Submit" type="submit">
          <input name="RESET" id="RESET" value="Reset" type="reset">
          <span class="AllText style4 style1"><b>*</b> wajib diisi </span></div></td>
      </tr>
      <tr align="left">
        <td colspan="2"><span class="style10">*Nb : Barang/Dokumen yang 
akan anda kirim bisa diambil oleh kurir kami ,Untuk wilayah area Jakarta
 tidak di kenakan biaya, di luar Jakarta akan di kenakan biaya sesuai 
lokasi dan tempat.</span></td>
      </tr>
    </tbody>
  </table>
<br>
</form>


</body></html>