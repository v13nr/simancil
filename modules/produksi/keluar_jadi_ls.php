<head>
<meta charset="utf-8" />
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="assets/jqueryui/jquery-ui.css" />
<script src="assets/jqueryui/jquery-1.9.1.js"></script>
<script src="assets/jqueryui/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/jqueryui/style.css" />
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>
</head>
<?php
	@session_start();
	require_once('modules/produksi/include/globalx.php');
	require_once('modules/produksi/include/functions.php');
	require_once('modules/produksi/otentik_produksi_nonBox.php');
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = mysql_query("SELECT * FROM nas_produksi.produksi WHERE id = '$id'");
		$data = mysql_fetch_array($sql, $dbh_produksi);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>PENGELUARAN </h5>
				</div>
				<!-- end box / title -->
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Produksi</th>
								<th>Keluar</th>
								<th>Unit</th>
								<th colspan="2">Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<form action="modules/produksi/submission_produksi.php" method="post" id="formRekening">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="cmd" value="upd_keluarjadi" />
								<tr align="center">
									<td><img src="images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
									<td><input type="text" name="tanggal" value="<?php echo baliktglindo($data['tanggal']); ?>"></td>
									<td>
										<input type="text" name="produksi" value="<?php echo $data['produksi']; ?>" style="width: 30px;" readonly="true">
									</td>
									<td>
										<input type="text" name="keluar" value="<?php echo $data['pengeluaran']; ?>" style="width: 30px;">
									</td>
									<td>
										<select name="unit" class="tes">
											<option value="Unit 1" <?php echo $data['unit']=='Unit 1' ? 'selected' : ''; ?>>Unit 1</option>
											<option value="Unit 2" <?php echo $data['unit']=='Unit 2' ? 'selected' : ''; ?>>Unit 2</option>
										</select>
									</td>
									<td><input type="image" src="resources/images/save.png" title="Simpan" /></td>
									<td><a href="index.php?mn=keluar_jadi_ls&getmodule=<?php echo base64_encode('produksi/');?>"><img src="resources/images/back.png" title="Batal" /></a></td>
								</tr>							
							</form>
						</tbody>
					</table>
				</div>
			</div>
			<!-- end table -->
		</div>
<?php	
	}
	else{	
		$idDivisi = $_SESSION["sess_tipe"];
		$rs_PerHal=5;
		if(isset($_GET['hal'])){
			$noHal=$_GET['hal'];	
		} else{
			$noHal=1;	
		}
		$offset = ($noHal-1)*$rs_PerHal;
		if(isset($_GET['submitSearch']) && $_GET['search']<> ""){
			$search = $_GET['search'];
			$SQL = "SELECT * FROM nas_produksi.produksi WHERE terima = '$search' AND status = 1 AND id_divisi = '$idDivisi'  ORDER BY tanggal LIMIT $offset,$rs_PerHal";
			$datas = mysql_query($SQL, $dbh_produksi) or die(mysql_error($SQL));		
		}	
		else
			$SQL = "SELECT * FROM nas_produksi.produksi WHERE status = 1 AND id_divisi = '$idDivisi'  ORDER BY tanggal LIMIT $offset,$rs_PerHal";
			//echo $SQL;
			$datas = mysql_query($SQL, $dbh_produksi) or die(mysql_error());
		$jumlah = mysql_num_rows($datas);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>PENGELUARAN </h5>
					<div class="search">
						<form action="index.php" method="get">
							<div class="input">
								<input type="hidden" name="mn" value="keluar_jadi_ls">
								<input type="hidden" name="getmodule" value="<?php echo base64_encode('produksi') ?>">
								<input type="text" id="search" name="search" />
							</div>
							<div class="button">
								<input type="submit" name="submitSearch" value="Search" />
							</div>
						</form>
					</div>
			  </div>
				<!-- end box / title -->
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Produksi</th>
								<th>Keluar</th>
								<th>Unit </th>
								<th colspan="2">Pilihan</th>
							</tr>
						</thead>
						<tbody>
						<form action="modules/produksi/submission_produksi.php" method="post" id="formRekening">
						<input type="hidden" name="cmd" value="add_pjadi" />
					  </form>
							<?php
								if($jumlah == 0){
							?>
									<tr>
										<td colspan="6" style="color:#f00; text-align:center;">Mohon maaf, tidak ada data yang dimaksud</td>
									</tr>
							<?
								}
								else{
									$no = $offset+1;
									while($data = mysql_fetch_array($datas)){
							?>
										<tr align="center">
											<td><?php echo $no; ?></td>
											<td><?php echo baliktglindo($data['tanggal']); ?></td>
											<td align="center"><?php echo $data['produksi']; ?></td>
											<td align="center"><?php echo $data['pengeluaran']; ?></td>
											<td><?php echo $data['unit']; ?></td>
											<td><a href="index.php?mn=keluar_jadi_ls&getmodule=<?php echo base64_encode('produksi/');?>&amp;id=<?php echo $data['id']; ?>" title="Edit"><img src="resources/images/edit.png" /></a></td>
											<td>&nbsp;</td>
										</tr>						
							<?php
										$no++;
									}
								}
							?>
						</tbody>
					</table>
					<?php
						if($jumlah > 0){
					?>
							<!-- pagination -->
							<div class="pagination pagination-left">
								<div class="results">
									<?php
										if(isset($_GET['submitSearch']))
											$rekening = mysql_query("SELECT terima FROM nas_produksi.produksi WHERE terima = '$search' AND id_divisi = '$idDivisi'");
										else
											$rekening = mysql_query("SELECT terima FROM nas_produksi.produksi WHERE id_divisi = '$idDivisi'");	
										$jumlah_rekening = mysql_num_rows($rekening);
									?>
									<span>showing results <?php echo ++$offset.'-'.--$no; ?> of <?php echo $jumlah_rekening; ?></span>
								</div>
								<ul class="pager">
									<?php
										if(isset($_GET['submitSearch'])){
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM nas_produksi.produksi WHERE terima = '$search' AND id_divisi = '$idDivisi'";
											//$link = 
											$prev = 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&submitSearch=true&search='.$search.'&hal='.($noHal-1);
											$next = 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&submitSearch=true&search='.$search.'&hal='.($noHal+1);
										} else{
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM nas_produksi.produksi WHERE id_divisi = '$idDivisi'";
											//$link = 
											$prev = 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&hal='.($noHal-1);
											$next = 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&hal='.($noHal+1);
										}
										$hasil = mysql_query($query, $dbh_produksi);
										//echo $query;
										$data = mysql_fetch_array($hasil);
										//----Paging : Menampilkan data per halaman --------
										$rs_Jumlah = $data['rs_Jumlah'];
										$jumPage = ceil($rs_Jumlah/$rs_PerHal);
										if(!isset($showPage)) $showPage = 0;
										if ($noHal > 1) echo  "<li><a href=\"$prev\"> &laquo; prev</a></li>";
										for($hal = 1; $hal <= $jumPage; $hal++)
										{
										  if ((($hal >= $noHal - 3) && ($hal <= $noHal + 3)) || ($hal == 1) || ($hal == $jumPage)) 
										  {   
											if (($showPage == 1) && ($hal != 2))  echo "<li class=\"separator\">...</li>"; 
											if (($showPage != ($jumPage - 1)) && ($hal == $jumPage))  echo "<li class=\"separator\">...</li>";
											$link = isset($_GET['submitSearch']) ? 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&submitSearch=true&search='.$search.'&hal='.$hal : 'index.php?mn=keluar_jadi_ls&getmodule='.base64_encode('produksi/').'&hal='.$hal; 
											if ($hal == $noHal) echo "<li class=\"current\">".$hal."</li>";
											else echo "<li><a href=\"$link\">".$hal."</a></li>";
											$showPage = $hal;          
										  }
										}
										if ($noHal < $jumPage) echo "<li><a href=\"$next\">next &raquo;</a></li>";
									?>
								</ul>
							</div>
							<!-- end pagination -->			
					<?php
						}
					?>
				</div>
			</div>
			<!-- end table -->
		</div>
<?php
	}
?>
<!-- scripts (jquery) -->
<script src="resources/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
<!--[if IE]><script language="javascript" type="text/javascript" src="../assets/new/smooth admin/resources/scripts/excanvas.min.js"></script><![endif]-->
<script src="resources/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript"></script>
<script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
<!-- scripts (custom) -->
<script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
<script src="resources/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
	function confirmDelete(delUrl){
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")){
			document.location = delUrl;
		}
	}
	
	$(document).ready(function(){
		$("#formRekening").validate({
			rules:{
				norek:{
					required: true,
					number: true
				},
				namarek: "required"
			},
			messages:{
				norek: {
					required: "Kode Harus Diisi",
					number: "Kode Harus diisi"
				},
				namarek:{
					required: "Nama Harus diisi"
				}
			}
		});
	});
</script>