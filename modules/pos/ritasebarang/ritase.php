      <script src="../../../bootstrap5/js/jquery.min.js"></script>
      <script src="../../../bootstrap5/js/bootstrap.js"></script>
      <script src="../../../bootstrap5/js/jquery.validate.min.js"></script>
      <script src="../../../bootstrap5/js/sweetalert.min.js"></script>
      <link href="../../../bootstrap5/css/bootstrap.css" rel="stylesheet">
      <link href="../../../bootstrap5/css/app.css" rel="stylesheet">
	  
	  <div class="row">
		<div class="col col-md-4">
			<div class="card" style="width: 18rem;">
			  <img src="../../../assets/images/berangkat.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
				<h5 class="card-title">Berangkat</h5>
				<p class="card-text">Persiapan Ritase Penjualan Salesman</p>
				<a href="#" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">Go Entri</a>
			  </div>
			</div> 
		</div>
	  
		<div class="col col-md-4">
			<div class="card" style="width: 18rem;">
			  <img src="../../../assets/images/pulang.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
				<h5 class="card-title">Laporan Pulang</h5>
				<p class="card-text">Laporan hasil penjualan ritase</p>
				<a href="#" class="btn btn-primary">Go Reporting</a>
			  </div>
			</div>
		</div>
	  
		<div class="col col-md-4">
			<div class="card" style="width: 18rem;">
			  <img src="../../../assets/images/cetak.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
				<h5 class="card-title">Cetak Laporan</h5>
				<p class="card-text">Manaje dan Pelaporan Salesman</p>
				<a href="#" class="btn btn-primary">Laporan</a>
			  </div>
			</div>
		</div>
	  
	  </div>
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		Hari/Tgl. <input type="date"> &nbsp; &nbsp; &nbsp; Nama Sales <input type="text" size="16"><br><br>
        <table width="100%" border="1">
			<tr>
				<td>No.</td>
				<td>Volume</td>
				<td>Jenis Barang</td>
				<td>Harga Satuan</td>
				<td>Jumlah</td>
			</tr>
			<?php
			
			include "../../../config_sistem_i.php";

			$cols = Array ("namabrg", "kodebrg");
			$users = $db->get ("stock", null, $cols);
			if ($db->count > 0)
				foreach ($users as $user) { 
				?>
			   
			   
					<tr>
						<td><?php echo ++$no;?>. </td>
						<td><input type="text" size="2"></td>
						<td><?php echo $user["namabrg"];?></td>
						<td><input type="text" size="12"></td>
						<td><input type="text" size="12"></td>
					</tr>
					
					
			   <?php
				}
			?>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>