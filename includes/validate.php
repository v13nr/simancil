<?php

//validating admin store add

function validate_store_add(){

global $lang; 
global $fields; 
global $errors; 


	// define form fields
	$fields = array(
		'name'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_NAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'address'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_ADDRESS_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'telephone'=>array(
			'rule'=>'/[0-9 +]/',
			'message'=>$lang['ADMIN_STORE_TELEPHONE_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'email'=>array(
			'rule'=>"/^([a-z0-9\+_\-']+)(\.[a-z0-9\+_\-']+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
			'message'=>$lang['ADMIN_STORE_EMAIL_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'website'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_WEBSITE_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'description'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_DESCRIPTION_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'latitude'=>array(
			'rule'=>'/[0-9.\-]/',
			'message'=>$lang['ADMIN_STORE_LATITUDE_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'longitude'=>array(
			'rule'=>'/[0-9.\-]/',
			'message'=>$lang['ADMIN_STORE_LONGITUDE_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);

	
	$session_id = session_id();
	
	$tmp_upload_folder = ROOT.'temp_upload/'.$session_id.'/';
	
	$resize_image_width = 100;


	
	if(isset($_POST['delete_image'])) {
		
		$delete = array_keys($_POST['delete_image']);
		$image = $delete[0];
		
		if(file_exists($tmp_upload_folder.$image)) {
			
			if(!@unlink($tmp_upload_folder.$image)) {
				$errors = $lang['ADMIN_STORE_IMAGE_DELETE_FAILED'].$v;
			}
		}
	}


	// form submissoin
	if($_POST) {

		$errors = array();
		foreach($fields as $k=>$v) {
			
			if(isset($_POST[$k])) {
				
				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;
				
				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {
					
					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {
						
						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			
			$fields[$k]['value'] = $_POST[$k];
			}
		}
		
		
		if($_FILES && $_FILES['file']['error'] != 4) {
			
			$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
			
			
			if(!in_array($_FILES['file']['type'],$allowed_mimetypes)) {
				$errors[] = $lang['ADMIN_STORE_ALLOWED_IMAGE'];
			} else {
				
				create_dir($tmp_upload_folder);
				
				
				$img  = new Image(array('filename'=>$_FILES['file']['tmp_name']));
				
				if($img !== FALSE) {
					
					if($img->resize_to_width($resize_image_width)) {
						
						$safe_name = strtolower(str_replace(' ','_',preg_replace('/[^a-zA-Z0-9\-_. ]/','',$_FILES['file']['name'])));
						
						
						if(!$img->save($tmp_upload_folder.$safe_name)) {
							$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
						}
					} else {
						$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
					}
				} else {
					$errors[] = $lang['ADMIN_STORE_IMAGE_FAILED'];
				}
			}
		}
		
		$_POST['cat_id'] = $_POST['catlist'];
		if(empty($errors)) {
			$db = db_connect();
			
			
			$_POST['approved'] = 1;
			if (!get_magic_quotes_gpc()) { 
			 $_POST['name'] = addslashes($_POST['name']);
			 $_POST['address'] = addslashes($_POST['address']);
			}
			if(!$db->insert('stores',$_POST)) {
				$errors[] = $lang['ADMIN_STORE_SAVE_FAILED'];
			} else {
				
				$insert_id = $db->get_insert_id();
				
				
				if(is_dir($tmp_upload_folder)) {
					$files = get_files($tmp_upload_folder);
					if(!empty($files)) {
						
						if(create_dir(ROOT.'imgs/stores/'.$insert_id)) {					
							
							foreach($files as $k=>$v) {
								if(@copy(ROOT.'temp_upload/'.$session_id.'/'.$v,ROOT.'imgs/stores/'.$insert_id.'/'.$v)) {
									@unlink(ROOT.'temp_upload/'.$session_id.'/'.$v);
								}
							}
						}
					}
				}
				
				
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_STORE_SAVED']);
				redirect(ROOT_URL.'stores.php');
			}
		}
	}

	
	$images = array();
	if(is_dir($tmp_upload_folder)) {
		$images = get_files($tmp_upload_folder);
		foreach($images as $k=>$v) {
			$images[$k] = ROOT_URL.'temp_upload/'.$session_id.'/'.$v;
		}
	}
}

// Validate edit store

function validate_edit_store(){

global $lang;
global $fields;
global $upload_dir;
global $store;
global $errors; 


	
	$fields = array(
		'name'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_NAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'address'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_ADDRESS_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'telephone'=>array(
			'rule'=>'/[0-9 +]/',
			'message'=>$lang['ADMIN_STORE_TELEPHONE_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'email'=>array(
			'rule'=>"/^([a-z0-9\+_\-']+)(\.[a-z0-9\+_\-']+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
			'message'=>$lang['ADMIN_STORE_EMAIL_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'website'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_WEBSITE_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'description'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_STORE_DESCRIPTION_VALIDATE'],
			'value'=>'',
			'required'=>FALSE
		),
		'latitude'=>array(
			'rule'=>'/[0-9.\-]/',
			'message'=>$lang['ADMIN_STORE_LATITUDE_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'longitude'=>array(
			'rule'=>'/[0-9.\-]/',
			'message'=>$lang['ADMIN_STORE_LONGITUDE_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);


	//if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	if(!isset($_GET['id'])){
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'main.php');
	}

	$db = db_connect();

	mysql_query("SET NAMES utf8"); 
	$store = $db->get_row("SELECT rekening.* FROM rekening WHERE rekening.norek='".$db->escape($_GET['id'])."'");
	if(empty($store)) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'main.php');
	}


	$upload_dir = ROOT.'imgs/main/'.$store['id'].'/';

	$resize_image_width = 100;


	if(isset($_POST['delete_image'])) {

		$delete = array_keys($_POST['delete_image']);
		$image = $delete[0];


		if(file_exists($upload_dir.$image)) {

			if(!@unlink($upload_dir.$image)) {
				$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_STORE_IMAGE_DELETE_FAILED'].$v);
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_STORE_IMAGE_DELETED']);
			}
		} else {
			$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_STORE_IMAGE_NOT_EXIST']);
		}
		
	redirect(ROOT_URL.'stores_edit.php?id='.$store['id']);
	}


	if($_POST) {
		$errors = array();
		foreach($fields as $k=>$v) {

			if(isset($_POST[$k])) {

				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;

				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {

					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {

						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			

			$fields[$k]['value'] = $_POST[$k];
			}
		}
		

		if($_FILES && $_FILES['file']['error'] != 4) {

			$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');

			if(!is_dir($upload_dir)) {
				create_dir($upload_dir);
			}
			

			if(!in_array($_FILES['file']['type'],$allowed_mimetypes)) {
				$errors[] = $lang['ADMIN_STORE_ALLOWED_IMAGE'];
			} else {

				$img  = new Image(array('filename'=>$_FILES['file']['tmp_name']));

				if($img !== FALSE) {

					if($img->resize_to_width($resize_image_width)) {

						$safe_name = strtolower(str_replace(' ','_',preg_replace('/[^a-zA-Z0-9\-_. ]/','',$_FILES['file']['name'])));
						

						if(!$img->save($upload_dir.$safe_name)) {
							$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
						}
					} else {
						$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
					}
				} else {
					$errors[] = $lang['ADMIN_STORE_IMAGE_FAILED'];
				}
			}
		}
		$_POST['cat_id'] = $_POST['catlist'];
		if(empty($errors)) {

			$_POST['approved'] = 1;
			if (!get_magic_quotes_gpc()) { 
			 $_POST['name'] = addslashes($_POST['name']);
			 $_POST['address'] = addslashes($_POST['address']);
			}
			if(!$db->update('stores',$_POST,$_GET['id'])) {
				$errors[] = $lang['ADMIN_STORE_SAVE_FAILED'];
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_STORE_SAVED']);
				redirect(ROOT_URL.'stores.php');
			}
		}
	} else {

		foreach($fields as $k=>$v) {
			if(isset($store[$k])) {
				$fields[$k]['value'] = $store[$k];
			}
		}
	}


	
}


// validate add user

function validate_user_add(){

global $fields;
global $lang; 	
global $errors;

	$fields = array(
		'username'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_USERNAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'password'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_PASSWORD_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'cpassword'=>array(
			'rule'=>'/[0-9 +]/',
			'message'=>$lang['ADMIN_CONFIRM_PASSWORD_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);

	
	if($_POST) {

		$errors = array();
		foreach($fields as $k=>$v) {
			
			if(isset($_POST[$k])) {
				
				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;
				
				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {
					
					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {
						
						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
		
			$fields[$k]['value'] = $_POST[$k];
			}
		}
		
		
		if($fields['password']['value']!=$fields['cpassword']['value']){
		   $errors[] = $lang['ADMIN_PASSWORD_NOT_MATCHED'];
		}
		
		
		$db = db_connect();
		$users = $db->get_rows("SELECT users.* FROM users WHERE users.username='".$fields['username']['value']."'");
		
		if(!empty($users)){
		 $errors[] = $lang['ADMIN_USERNAME_EXIST'];
		}
		
		if(empty($errors)) {
			$db = db_connect();
			
			
			$_POST['password'] = md5($fields['cpassword']['value'].SALT);
			
			if(!$db->insert('users',$_POST)) {
				$errors[] = $lang['ADMIN_USERNAME_CREATE_FAILED'];
			} else {
				
				
				
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_USERNAME_SAVED']);
				redirect(ROOT_URL.'users.php');
			}
		}
	}
}

// validate user edit

function validate_user_edit(){

global $fields;
global $lang; 	
global $errors;
global $user;

	
	$fields = array(
		'username'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_USERNAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'password'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_PASSWORD_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		),
		'cpassword'=>array(
			'rule'=>'/[0-9 +]/',
			'message'=>$lang['ADMIN_CONFIRM_PASSWORD_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);

	
	if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'users.php');
	}

	
	$db = db_connect();
	$user = $db->get_row("SELECT users.* FROM users WHERE users.id=".$db->escape($_GET['id']));
	if(empty($user)) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'users.php');
	}


	if($_POST) {
		$errors = array();
		foreach($fields as $k=>$v) {

			if(isset($_POST[$k])) {

				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;

				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {

					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {

						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			

			$fields[$k]['value'] = $_POST[$k];
			}
		}
		
		if($fields['password']['value']!=$fields['cpassword']['value']){
		   $errors[] = $lang['ADMIN_PASSWORD_NOT_MATCHED'];
		}
		

		
		if(empty($errors)) {
			// password encryption
			$_POST['password'] = md5($fields['cpassword']['value'].SALT);
			
			if(!$db->update('users',$_POST,$_GET['id'])) {
				$errors[] = $lang['ADMIN_USERNAME_EDIT_FAILED'];
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_USERNAME_SAVED']);
				redirect(ROOT_URL.'users.php');
			}
		}
	} else {
	
		foreach($fields as $k=>$v) {
			if(isset($user[$k])) {
				$fields[$k]['value'] = $user[$k];
			}
		}
	}

}


// validate change password


function validate_change_password(){

global $fields;
global $lang; 	
global $errors;
global $user;

	$fields = array(
		'password'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_PLEASE_ENTER_PASSWORD'],
			'value'=>'',
			'required'=>TRUE
		),
		'cpassword'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['ADMIN_PLEASE_CONFIRM_PASSWORD'],
			'value'=>'',
			'required'=>TRUE
		)
	);


	$db = db_connect();
	$user = $db->get_row("SELECT users.* FROM users WHERE users.id=".$db->escape($_SESSION['User']['id']));
	if(empty($user)) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'index.php');
	}


	if($_POST) {
		$errors = array();
		foreach($fields as $k=>$v) {
			
			if(isset($_POST[$k])) {
				
				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;
				
				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {
					
					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {
						
						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			
			
			$fields[$k]['value'] = $_POST[$k];
			}
		}

		if($fields['password']['value']!=$fields['cpassword']['value']){
		   $errors[] = $lang['ADMIN_PASSWORD_NOT_MATCHED'];
		}
		
		if(empty($errors)) {
			
			$_POST['password'] = md5($fields['cpassword']['value'].SALT);
			
			if(!$db->update('users',$_POST,$_SESSION['User']['id'])) {
				$errors[] = $lang['ADMIN_PASSWORD_CHANGE_FAILED'];
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_PASSWORD_CHANGED']);
				
			}
		}
	} else {
		
		foreach($fields as $k=>$v) {
			if(isset($user[$k])) {
				$fields[$k]['value'] = $user[$k];
			}
		}
	}


}

// validate add category


function validate_cat_add(){

global $lang; 
global $fields; 
global $errors; 

	// define form fields
	$fields = array(
		'cat_name'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['SSF_ADMIN_CAT_NAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);

	
	$session_id = session_id();
	
	$tmp_upload_folder = ROOT.'temp_upload/'.$session_id.'/';
	
	$resize_image_width = 100;


	
	if(isset($_POST['delete_image'])) {
		
		$delete = array_keys($_POST['delete_image']);
		$image = $delete[0];
		
		if(file_exists($tmp_upload_folder.$image)) {
			
			if(!@unlink($tmp_upload_folder.$image)) {
				$errors = $lang['SSF_ADMIN_CAT_DELETE_IMAGE_FAILED'].$v;
			}
		}
	}


	// form submissoin
	if($_POST) {

		$errors = array();
		foreach($fields as $k=>$v) {
			
			if(isset($_POST[$k])) {
				
				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;
				
				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {
					
					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {
						
						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			
			$fields[$k]['value'] = $_POST[$k];
			}
		}
		
		
		if($_FILES && $_FILES['file']['error'] != 4) {
			
			$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
			
			
			if(!in_array($_FILES['file']['type'],$allowed_mimetypes)) {
				$errors[] = $lang['ADMIN_STORE_ALLOWED_IMAGE'];
			} else {
				
				create_dir($tmp_upload_folder);
				
				
				$img  = new Image(array('filename'=>$_FILES['file']['tmp_name']));
				
				if($img !== FALSE) {
					
					if($img->resize_to_width($resize_image_width)) {
						
						$safe_name = strtolower(str_replace(' ','_',preg_replace('/[^a-zA-Z0-9\-_. ]/','',$_FILES['file']['name'])));
						
						
						if(!$img->save($tmp_upload_folder.$safe_name)) {
							$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
						}
					} else {
						$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
					}
				} else {
					$errors[] = $lang['ADMIN_STORE_IMAGE_FAILED'];
				}
			}
		}
		
		if(empty($errors)) {
			$db = db_connect();
			
			

			if (!get_magic_quotes_gpc()) { 
			 $_POST['cat_name'] = addslashes($_POST['cat_name']);

			}
			if(!$db->insert('categories',$_POST)) {
				$errors[] = $lang['SSF_ADMIN_CAT_SAVE_FAILED'];
			} else {
				
				$insert_id = $db->get_insert_id();
				
				
				if(is_dir($tmp_upload_folder)) {
					$files = get_files($tmp_upload_folder);
					if(!empty($files)) {
						
						if(create_dir(ROOT.'imgs/categories/'.$insert_id)) {					
							
							foreach($files as $k=>$v) {
								if(@copy(ROOT.'temp_upload/'.$session_id.'/'.$v,ROOT.'imgs/categories/'.$insert_id.'/'.$v)) {
									@unlink(ROOT.'temp_upload/'.$session_id.'/'.$v);
								}
							}
						}
					}
				}
				
				
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['SSF_ADMIN_CAT_SAVED']);
				redirect(ROOT_URL.'categories.php');
			}
		}
	}

	
	$images = array();
	if(is_dir($tmp_upload_folder)) {
		$images = get_files($tmp_upload_folder);
		foreach($images as $k=>$v) {
			$images[$k] = ROOT_URL.'temp_upload/'.$session_id.'/'.$v;
		}
	}
}



// Validate edit category

function validate_edit_cats(){

global $lang;
global $fields;
global $upload_dir;
global $cats;
global $errors; 


	
	$fields = array(
		'cat_name'=>array(
			'rule'=>'/.+/',
			'message'=>$lang['SSF_ADMIN_CAT_NAME_VALIDATE'],
			'value'=>'',
			'required'=>TRUE
		)
	);


	if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'categories.php');
	}

	$db = db_connect();

	mysql_query("SET NAMES utf8"); 
	$cats = $db->get_row("SELECT categories.* FROM categories WHERE categories.id=".$db->escape($_GET['id']));
	if(empty($cats)) {
		$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_INVALID_ID']);
		redirect(ROOT_URL.'categories.php');
	}


	$upload_dir = ROOT.'imgs/categories/'.$cats['id'].'/';

	$resize_image_width = 100;


	if(isset($_POST['delete_image'])) {

		$delete = array_keys($_POST['delete_image']);
		$image = $delete[0];


		if(file_exists($upload_dir.$image)) {

			if(!@unlink($upload_dir.$image)) {
				$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['SSF_ADMIN_CAT_DELETE_IMAGE_FAILED'].$v);
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['ADMIN_STORE_IMAGE_DELETED']);
			}
		} else {
			$_SESSION['notification'] = array('type'=>'bad','msg'=>$lang['ADMIN_STORE_IMAGE_NOT_EXIST']);
		}
		
	redirect(ROOT_URL.'category_edit.php?id='.$cats['id']);
	}


	if($_POST) {
		$errors = array();
		foreach($fields as $k=>$v) {

			if(isset($_POST[$k])) {

				$required = (isset($v['required'])) ? (!empty($_POST[$k])) ? TRUE : $v['required']  : TRUE ;

				if(isset($v['rule']) && $required && !preg_match($v['rule'], $_POST[$k]) ) {

					if(isset($v['rule']) && !preg_match($v['rule'], $_POST[$k]) ) {

						if(isset($v['message']) && !empty($v['message'])) {
							$errors[] = $v['message'];
						}
					}
				}
			

			$fields[$k]['value'] = $_POST[$k];
			}
		}
		

		if($_FILES && $_FILES['file']['error'] != 4) {

			$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');

			if(!is_dir($upload_dir)) {
				create_dir($upload_dir);
			}
			

			if(!in_array($_FILES['file']['type'],$allowed_mimetypes)) {
				$errors[] = $lang['ADMIN_STORE_ALLOWED_IMAGE'];
			} else {

				$img  = new Image(array('filename'=>$_FILES['file']['tmp_name']));

				if($img !== FALSE) {

					if($img->resize_to_width($resize_image_width)) {

						$safe_name = strtolower(str_replace(' ','_',preg_replace('/[^a-zA-Z0-9\-_. ]/','',$_FILES['file']['name'])));
						

						if(!$img->save($upload_dir.$safe_name)) {
							$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
						}
					} else {
						$errors[] = $lang['ADMIN_STORE_THUMB_FAILED'];
					}
				} else {
					$errors[] = $lang['ADMIN_STORE_IMAGE_FAILED'];
				}
			}
		}
		
		if(empty($errors)) {


			if (!get_magic_quotes_gpc()) { 
			 $_POST['cat_name'] = addslashes($_POST['cat_name']);

			}
			if(!$db->update('categories',$_POST,$_GET['id'])) {
				$errors[] = $lang['SSF_ADMIN_CAT_SAVE_FAILED'];
			} else {
				$_SESSION['notification'] = array('type'=>'good','msg'=>$lang['SSF_ADMIN_CAT_SAVED']);
				redirect(ROOT_URL.'categories.php');
			}
		}
	} else {

		foreach($fields as $k=>$v) {
			if(isset($cats[$k])) {
				$fields[$k]['value'] = $cats[$k];
			}
		}
	}


	
}

?>