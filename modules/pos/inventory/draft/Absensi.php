<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Absensi</title>
<style type="text/css">
<!--
body {
	background-image: url(image/back.png);
}
.style5 {
	font-size: 12px;
	font-family: "Segoe UI";
}
.style8 {
	color: #FF0000;
	font-weight: bold;
}
.style9 {color: #FF0000}
.style10 {font-size: 12px; color: #0000FF; font-family: "Segoe UI";}
.style13 {color: #FFFFFF}
.style15 {font-size: 9px; color: #0000FF; font-family: "Segoe UI"; font-weight: bold; }
.style18 {color: #333333; font-weight: bold; }
-->
</style></head>

<body>
<div align="center">
  <table width="1024" border="0" cellspacing="1" bgcolor="#f1f1f1">
    <tr>
      <td colspan="7" bgcolor="#FFFFFF" class="style5"><img src="image/headerchen.png" width="1024" height="100" /></td>
    </tr>
    <tr>
      <td colspan="7" bgcolor="#FFFFFF" class="style5">&nbsp;</td>
    </tr>
    <tr>
      <td width="81" bgcolor="#FFFFFF" class="style5">&nbsp;<span class="style8">Departemen</span> </td>
      <td width="10" bgcolor="#FFFFFF" class="style5"><div align="center">:</div></td>
      <td width="539" bgcolor="#FFFFFF"><form id="form4" name="form4" method="post" action="">
        <label>
          <select name="select" class="style5">
            <option>- Pilih Departemen -</option>
            <option>Security</option>
            <option>Staff</option>
            <option>Dll</option>
          </select>
          </label>
      </form>      </td>
      <td colspan="2" bgcolor="#FFFFFF"><img src="image/kalkulasi.png" width="110" height="20" /></td>
      <td width="112" bgcolor="#FFFFFF"><a href="http://localhost/simchen/LapAbsen.php"><img src="image/laporan.png" width="110" height="20" border="0" /></a></td>
      <td width="158" bgcolor="#FFFFFF"><img src="image/ekspor.png" width="110" height="20" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style5"><span class="style9">&nbsp;<strong>Nama</strong></span></td>
      <td bgcolor="#FFFFFF" class="style5"><div align="center">:</div></td>
      <td valign="middle" bgcolor="#FFFFFF"><form id="form1" name="form1" method="post" action="">
        <label>
          <input type="text" name="textfield" />
          </label>
        <img src="image/searhblitz.png" width="20" height="20" align="top" />
      </form>      </td>
      <td width="104" bgcolor="#FFFFFF" class="style10">Range Waktu </td>
      <td width="4" bgcolor="#FFFFFF" class="style5"><div align="center">:</div></td>
      <td colspan="2" bgcolor="#FFFFFF"><label>
        <select name="select3" class="style5">
          <option>- Pilih Tanggal -</option>
          <option>01/01/2010</option>
          <option>02/02/2010</option>
          <option>03/03/2010</option>
        </select>
      </label>
        <span class="style5">s/d</span>
        <select name="select4" class="style5">
  <option>- Pilih Tanggal -</option>
  <option>01/01/2010</option>
  <option>02/02/2010</option>
  <option>03/03/2010</option>
</select></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style10">Filterisasi</td>
      <td colspan="3" valign="top" bgcolor="#FFFFFF" class="style5"><form id="form5" name="form5" method="post" action="">
        <label>
        <input type="checkbox" name="checkbox4" value="checkbox" />
        </label>
      Nama
      <input type="checkbox" name="checkbox3" value="checkbox" />
      <label>User Id 
      <input type="checkbox" name="checkbox2" value="checkbox" />
      </label>
      Departemen
      <label>
      <input type="checkbox" name="checkbox" value="checkbox" />
      </label>
      Waktu
      </form>      </td>
    </tr>
    <tr>
      <td colspan="7" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </table>
  <table width="1024" border="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#FFFFFF" class="style5">
    <tr>
      <td width="7" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="19" bgcolor="#E1E28A"><div align="center" class="style18">No</div></td>
      <td width="53" bgcolor="#E1E28A"><div align="center" class="style18">
        <div align="center">Nomor Induk </div>
      </div></td>
      <td width="167" bgcolor="#E1E28A"><div align="center" class="style18">Nama</div></td>
      <td width="77" bgcolor="#E1E28A"><div align="center" class="style18">Tanggal</div></td>
      <td width="86" bgcolor="#E1E28A"><div align="center" class="style18">Jam Kerja </div></td>
      <td width="65" bgcolor="#E1E28A"><div align="center" class="style18">Masuk </div></td>
      <td width="64" bgcolor="#E1E28A"><div align="center" class="style18">Pulang </div></td>
      <td width="49" bgcolor="#E1E28A"><div align="center" class="style18">Jam Masuk</div></td>
      <td width="56" bgcolor="#E1E28A"><div align="center" class="style18">Jam Keluar</div></td>
      <td width="57" bgcolor="#E1E28A"><div align="center" class="style18">Telat</div></td>
      <td width="58" bgcolor="#E1E28A"><div align="center" class="style18">Pulang Awal </div></td>
      <td width="45" bgcolor="#E1E28A"><div align="center" class="style18">Alpa</div></td>
      <td width="54" bgcolor="#E1E28A"><div align="center" class="style18">Lembur</div></td>
      <td width="52" bgcolor="#E1E28A"><div align="center" class="style18">Waktu Kerja </div></td>
      <td width="51" bgcolor="#E1E28A"><div align="center" class="style18">Status</div></td>
      <td width="12"><div align="center"></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">1</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">01 Juni 2010 </div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00 </div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">17:00</div></td>
      <td bgcolor="#FFFFCC"><div align="center">11:36 </div></td>
      <td bgcolor="#E0EEFE"><div align="center">14:17</div></td>
      <td bgcolor="#f1f1f1"><div align="center">03:36</div></td>
      <td bgcolor="#f1f1f1"><div align="center">02:43</div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">02:41</div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">2</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">02 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">3</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">03 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">4</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">04 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">17:00</div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">03:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">10:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">Lembur</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">5</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">05 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">6</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">06 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">7</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">07 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">17:00</div></td>
      <td bgcolor="#CB0000"><div align="center"></div></td>
      <td bgcolor="#CB0000"><div align="center"></div></td>
      <td bgcolor="#CB0000"><div align="center"></div></td>
      <td bgcolor="#CB0000"><div align="center"></div></td>
      <td bgcolor="#CB0000"><div align="center"><img src="image/user_delete.png" width="16" height="16" /></div></td>
      <td bgcolor="#CB0000">&nbsp;</td>
      <td bgcolor="#CB0000"><div align="center"></div></td>
      <td bgcolor="#CB0000"> <div align="center" class="style13">Alpa </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">8</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">08 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">9</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">09 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center">10</div></td>
      <td bgcolor="#f1f1f1"><div align="center">CWF01</div></td>
      <td bgcolor="#f1f1f1">&nbsp;iLugroup </td>
      <td bgcolor="#FFFFCC"><div align="center">10 Juni 2010</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00 - 17:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">08:00</div></td>
      <td bgcolor="#f1f1f1"><div align="center">
        <div align="center">17:00</div>
      </div></td>
      <td bgcolor="#FFFFCC"><div align="center"></div></td>
      <td bgcolor="#E0EEFE"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#88ACD8">&nbsp;</td>
      <td bgcolor="#f1f1f1">&nbsp;</td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td bgcolor="#f1f1f1"><div align="center"></div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="1024" border="0" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td width="366"><div align="center"></div></td>
      <td width="62">&nbsp;</td>
      <td width="51" class="style15"><span class="style9">&lt;&lt; </span>Page 1 </td>
      <td width="37" class="style15">Page 2 </td>
      <td width="49" class="style15">Page 3 <span class="style9">&gt;&gt; </span></td>
      <td width="84"><img src="image/next.gif" width="82" height="22" /></td>
      <td width="357">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="7"><img src="image/footer.png" width="1024" height="30" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
</body>
</html>
