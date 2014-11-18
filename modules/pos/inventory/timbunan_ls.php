<script type="text/javascript" src="assets/kalendar_files/jsCalendar.js"></script>
<link href="assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<?php
	@session_start();
	require_once('modules/pos/include/globalx.php');
	require_once('modules/pos/include/functions.php');
	require_once('otentik_inv_nonBox.php');
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = mysql_query("SELECT * FROM $database.rek WHERE norek = '$id'");
		$data = mysql_fetch_array($sql, $dbh_jogjaide);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>MASTER TIMBUNAN </h5>
				</div>
				<!-- end box / title -->
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Ret</th>
								<th>Total</th>
								<th colspan="2">Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<form action="modules/accounting/gli/submission_gli.php" method="post" id="formRekening">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="cmd" value="upd_rekening" />
								<tr align="center">
									<td><img src="images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
									<td><input type="text" name="norek" value="<?php echo $data['norek']; ?>"></td>
									<td>
										<input type="text" name="namarek" value="<?php echo $data['namarek']; ?>" style="width: 300px;">
									</td>
									<td>&nbsp;</td>
									<td><input type="image" src="resources/images/save.png" title="Simpan" /></td>
									<td><a href="index.php?mn=rekening_ls&getmodule=<?php echo base64_encode('accounting/gli/');?>"><img src="resources/images/back.png" title="Batal" /></a></td>
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
		$rs_PerHal=50000;
		if(isset($_GET['hal'])){
			$noHal=$_GET['hal'];	
		} else{
			$noHal=1;	
		}
		$offset = ($noHal-1)*$rs_PerHal;
		if(isset($_GET['submitSearch'])){
			$search = $_GET['search'];
			$SQL = "SELECT * FROM $database.timbunan WHERE tanggal LIKE '%".baliktgl($search)."%' AND status = 1 AND id_divisi = '$idDivisi' ORDER BY norek LIMIT $offset,$rs_PerHal";
			$datas = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error($SQL));		
		}	
		else
			$SQL = "SELECT * FROM $database.timbunan ORDER BY tanggal LIMIT $offset,$rs_PerHal";
			//echo $SQL;
			$datas = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$jumlah = mysql_num_rows($datas);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>MASTER TIMBUNAN </h5>
					<div class="search">
					</div>
				</div>
				<!-- end box / title -->
				<div class="table">
					<table width="90%">
						<thead>
							<tr>
								<th width="8%">No</th>
								<th width="13%">Tanggal</th>
								<th width="32%">Ret</th>
								<th width="27%">Total</th>
								<th width="20%">Pilihan</th>
							</tr>
						</thead>
						<tbody>
						<form action="modules/pos/inventory/submission_inv.php" method="post" id="formRekening">
						<input type="hidden" name="cmd" value="add_timbunan" />
							<tr align="center">
								<td><img src="images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
								<td><input type="text" name="tanggal" value="" id="tanggal" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu"  />
      <a href="javascript:showCalendar('tanggal')"><img src="assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
								<td>
									<input type="text" name="ret" style="width: 100px;">								</td>
								<td>&nbsp;</td>
								<td><input type="submit" value="Simpan" />								</td>
							</tr>
							</form>
							<?php
								if($jumlah == 0){
							?>
									<tr>
										<td colspan="5" style="color:#f00; text-align:center;">Mohon maaf, tidak ada data yang dimaksud</td>
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
											<td align="center"><?php echo $data['ret'];  $total = $total + $data['ret']; ?></td>
											<td align="center"><?php echo number_format($total);  ?></td>
											<td><a href="index.php?mn=rekening_ls&getmodule=<?php echo base64_encode('accounting/gli/');?>&amp;id=<?php echo $data['norek']; ?>" title="Edit"></a><a href="javascript:confirmDelete('modules/pos/inventory/submission_inv.php?id=<?php echo $data['id']; ?>&amp;cmd=del_timbunan')" title="Hapus"><img src="resources/images/delete.gif" /></a></td>
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
											$rekening = mysql_query("SELECT tanggal FROM $database.timbunan WHERE tanggal LIKE '%".baliktgl($search)."%' AND id_divisi = '$idDivisi'");
										else
											$rekening = mysql_query("SELECT tanggal FROM $database.timbunan");	
										$jumlah_rekening = mysql_num_rows($rekening);
									?>
									<span>showing results <?php echo ++$offset.'-'.--$no; ?> of <?php echo $jumlah_rekening; ?></span>
								</div>
								<ul class="pager">
									<?php
										if(isset($_GET['submitSearch'])){
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM timbunan WHERE tanggal LIKE '%$search%'";
											//$link = 
											$prev = 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&submitSearch=true&search='.$search.'&hal='.($noHal-1);
											$next = 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&submitSearch=true&search='.$search.'&hal='.($noHal+1);
										} else{
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM $database.timbunan";
											//$link = 
											$prev = 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&hal='.($noHal-1);
											$next = 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&hal='.($noHal+1);
										}
										$hasil = mysql_query($query, $dbh_jogjaide) or die(mysql_error());
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
											$link = isset($_GET['submitSearch']) ? 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&submitSearch=true&search='.$search.'&hal='.$hal : 'index.php?mn=timbunan_ls&getmodule='.base64_encode('pos/inventory').'&hal='.$hal; 
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
					required: "Nomor Rekening Harus Diisi",
					number: "Nomor Rekening Harus Angka"
				},
				namarek:{
					required: "Nama Rekening Harus Diisi"
				}
			}
		});
	});
</script>