<?php  
session_start();
include "otentik_kepeg.php";
include "../../config_sistem.php"; 
?>
<head>

<script language="JavaScript">
	function CloseAndRefresh() 
{
    window.opener.location.href = window.opener.location.href;
    window.close();
}

</script>

</head>
<body>
<?php 
if ($_REQUEST['modx']=="ok") { ?>
			<?php  
			if($_GET["act"] == "insert" )
				{
				unset($nama_dokumen);
				if(!isset($_FILES) && isset($HTTP_POST_FILES))
					$_FILES = $HTTP_POST_FILES;

				$nama_dokumen = basename($_FILES['dokumen']['name']);
				$newdoc = 'foto/' . $nama_dokumen;				
						
						
					
					if($_FILES){
						$allowedExtensions = array("jpg","png");
					
						foreach($_FILES as $key=>$val){
							if(!empty($val['tmp_name'])){
								$ext = end(explode(".",strtolower(basename($val['name']))));
								if(in_array($ext,$allowedExtensions)){
									$file = 'foto/'.basename($val['name']);
					
									if(move_uploaded_file($val['tmp_name'],$file)){
										$tsql0 = "update mastpegawai set foto='" .$nama_dokumen ."'  where idno=". $_REQUEST['idusr'];
										$hasil = mysql_query($tsql0) or die(mysql_error());
										echo ("<font face='verdana' size='2'> ======   ".$nama_dokumen."  telah diupload. Silakan Klik Tombol Close. ======</font><br>");
										echo '<input name="close" type="button" id="close" value="Close" class="tombol" onclick="CloseAndRefresh();" />';
									}
								}else{
										echo "Gagal<br>";
										// never assume the upload succeeded
										if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
										   die("Upload failed with error code " . $_FILES['files']['error']);
										}

										$info = getimagesize($_FILES['file']['tmp_name']);
										if ($info === FALSE) {
										   die("Unable to determine image type of uploaded file");
										}

										if (($info[2] !== IMAGE_GIF) && ($info[2] !== IMAGE_JPEG) && ($info[2] !== IMAGE_PNG)) {
										   die("Not a gif/jpeg");
										}
								}
							}
						}
					}
					

				
				
				//echo ("<font face='verdana' size='2'> ======   ".$nama_dokumen."  telah diupload. Silakan Klik Tombol Close. ======</font><br>");
				//echo '<input name="close" type="button" id="close" value="Close" class="tombol" onclick="CloseAndRefresh();" />';
				//$result = move_uploaded_file($_FILES['dokumen']['tmp_name'], $newdoc);		

				if(empty($result))
				$error["result"] = "There was an error moving the uploaded file.";

					
				}
				else
				{
			?>
			<form enctype="multipart/form-data" id="form1" name="form1" method="post" action="upload.php?act=insert&idusr=<?php  echo  $_REQUEST['idusr'] ?>">
				<input type=hidden name="modx" value="ok">
			 <font face="verdana" size="2">Upload Foto : </font><input name="dokumen" type="file" class="form_isian"><br /><br />
			 <input name="update" type="submit" id="update" value="Update" class="tombol"/>
			 
			 </form>	

			<?php 
				}
	} else {
		echo "Gagal .. ";
	}
			?>

</body>