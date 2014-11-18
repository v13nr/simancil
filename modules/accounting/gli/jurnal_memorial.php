<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/new/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
		<style>
			body{
				background: #d2dee2;
			}
			
			fieldset{
				margin: 0 auto;
				width: 900px;
			}
		</style>
	</head>
	<body>
		<fieldset>
			<legend>Jurnal Memorial</legend>
			<div class="well">
				<form class="form-horizontal">
					<div class="control-group">
						<label class="control-label">No. Rekening</label>
						<div class="controls">
							<input type="text" name="norek" class="nomor" id="norek" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Nama Rekening</label>
						<div class="controls">
							<input type="text" name="namaRekening" id="namaRekening" disabled />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Jenis</label>
						<div class="controls">
							<input type="text" name="jenis" id="jenis" disabled />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Debet</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">Rp.</span>
								<input type="text" name="debet" />
							</div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Kredit</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">Rp.</span>
								<input type="text" name="kredit" />
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="submit" value="Simpan" class="btn btn-info" />
						</div>
					</div>				
				</form>			
			</div>
		</fieldset>
		<script type="text/javascript" src="../assets/new/js/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/new/js/jquery.alphanumeric.pack.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	
		<script type="text/javascript">
			$(document).ready(function(){			
				$("#norek").autocomplete({
					source: "autocomplete_jurnal_memorial.php?cmd=autocomplete",
					minLength: 1
				});		
				
				$("#norek").blur(function(){
					var norek = $(this).val();
					$.ajax({
						type: "GET",
						url: "autocomplete_jurnal_memorial.php?cmd=finish",
						data: "norek="+norek,
						dataType: "json",
						success: function(data){
							$("#namaRekening").val(data.namarek);
							$("#jenis").val(data.tipe);
						}
					});
				});
			});
		</script>
	</body>
</html>