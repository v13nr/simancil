<?php
	@session_start();
	//require_once('../../../../config_sistem.php');
	//require_once('otentik_gli_nonBox.php');
	if(isset($_GET['submitDel'])){
		$sql = "delete from stock where status = 0";
		$hasil = mysql_query($sql);
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = mysql_query("SELECT * FROM $database.stock WHERE kodebrg = '$id' where status = 0");
		$data = mysql_fetch_array($sql, $dbh_jogjaide);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>DATA RECYCLE INVENTORY</h5>
				</div>
				<!-- end box / title -->
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
							</tr>
						</thead>
						<tbody>
							<form action="modules/accounting/gli/submission_gli.php" method="post" id="formRekening">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="cmd" value="upd_rekening" />
								<tr align="center">
									<td><img src="images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
									<td><input type="text" name="norek" maxlength="4" value="<?php echo $data['norek']; ?>"></td>
									<td>
										<input type="text" name="namarek" value="<?php echo $data['namarek']; ?>" style="width: 300px;">
									</td>
									<td>
										<select name="tipe" class="tes">
											<option value="A" <?php echo $data['tipe']=='A' ? 'selected' : ''; ?>>A</option>
											<option value="P" <?php echo $data['tipe']=='P' ? 'selected' : ''; ?>>P</option>
											<option value="R" <?php echo $data['tipe']=='R' ? 'selected' : ''; ?>>R</option>
											<option value="R2" <?php echo $data['tipe']=='R2' ? 'selected' : ''; ?>>R2</option>
										</select>
									</td>
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
		$rs_PerHal=5;
		if(isset($_GET['hal'])){
			$noHal=$_GET['hal'];	
		} else{
			$noHal=1;	
		}
		$offset = ($noHal-1)*$rs_PerHal;
		if(isset($_GET['submitSearch'])){
			$search = $_GET['search'];
			$SQL = "SELECT * FROM $database.stock WHERE (namabrg LIKE '%$search%' OR kodebrg LIKE '%$search%') AND status = 0 AND divisi = '$idDivisi' ORDER BY kodebrg LIMIT $offset,$rs_PerHal";
			$datas = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error($SQL));		
		}	
		else
			$SQL = "SELECT * FROM $database.stock WHERE status = 0 ORDER BY namabrg LIMIT $offset,$rs_PerHal";
			//echo $SQL;
			$datas = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$jumlah = mysql_num_rows($datas);
?>
		<div id="content">
			<!-- table -->
			<div class="box">
				<!-- box / title -->
				<div class="title">
					<h5>DATA RECYCLE INVENTORY</h5>
					<div class="search">
						<form action="index.php" method="get">
							<div class="input">
								<input type="hidden" name="mn" value="rec_stok_ls">
								<input type="hidden" name="getmodule" value="<?php echo base64_encode('pos/inventory/') ?>">
								<input type="text" id="search" name="search" />
							</div>
							<div class="button">
								<input type="submit" name="submitSearch" value="Search" />
							</div>
							<div class="button">
								<input type="submit" name="submitDel" value="DELETE" />
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
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th colspan="2">Pilihan</th>
							</tr>
						</thead>
						<tbody>
						<?php
								if($jumlah == 0){
							?>
									<tr>
										<td colspan="6" style="color:#f00; text-align:center;">Data Recycle Kosong</td>
									</tr>
							<?
								}
								else{
									$no = $offset+1;
									while($data = mysql_fetch_array($datas)){
							?>
										<tr align="center">
											<td><?php echo $no; ?></td>
											<td><span  style="display:none" ><?php echo $data['kodebrg']; ?></span><?php echo $data['kodebrg']; ?></td>
											<td align="left"><?php echo $data['namabrg']; ?></td>
											<td><a href="index.php?mn=rekening_ls&getmodule=<?php echo base64_encode('accounting/gli/');?>&amp;id=<?php echo $data['norek']; ?>" title="Edit"><img style="display:none" src="resources/images/edit.png" /></a></td>
											<td><a href="javascript:confirmDelete('modules/accounting/gli/submission_gli.php?id=<?php echo $data['norek']; ?>&amp;cmd=del_rekening')" title="Hapus"><img style="display:none"  src="resources/images/delete.gif" /></a></td>
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
											$rekening = mysql_query("SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$search%' OR kodebrg LIKE '%$search%' ) AND status = 0 and divisi = '$idDivisi'");
										else
											$rekening = mysql_query("SELECT kodebrg, namabrg FROM $database.stock WHERE divisi = '$idDivisi' and status = 0");	
										$jumlah_rekening = mysql_num_rows($rekening);
									?>
									<span>showing results <?php echo ++$offset.'-'.--$no; ?> of <?php echo $jumlah_rekening; ?></span>
								</div>
								<ul class="pager">
									<?php
										if(isset($_GET['submitSearch'])){
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM stock WHERE namabrg LIKE '%$search%' and status = 0 AND divisi = '$idDivisi'";
											//$link = 
											$prev = 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&submitSearch=true&search='.$search.'&hal='.($noHal-1);
											$next = 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&submitSearch=true&search='.$search.'&hal='.($noHal+1);
										} else{
											$query = "SELECT COUNT(*) AS rs_Jumlah FROM stock WHERE divisi = '$idDivisi' and status = 0";
											//$link = 
											$prev = 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&hal='.($noHal-1);
											$next = 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&hal='.($noHal+1);
										}
										$hasil = mysql_query($query);
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
											$link = isset($_GET['submitSearch']) ? 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&submitSearch=true&search='.$search.'&hal='.$hal : 'index.php?mn=rec_stok_ls&getmodule='.base64_encode('pos/inventory/').'&hal='.$hal; 
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
					//number: true
				},
				namarek: "required"
			},
			messages:{
				norek: {
					required: "Nomor Rekening Harus Diisi",
					//number: "Nomor Rekening Harus Angka"
				},
				namarek:{
					required: "Nama Rekening Harus Diisi"
				}
			}
		});
	});
</script>