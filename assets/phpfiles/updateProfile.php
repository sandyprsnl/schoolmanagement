<?php
$uplodeType=[
	'image/png',
	'image/jpeg',
	'image/jpg'
	];
	$uploadok =0;
if(isset($_POST['updateprofile'])){
	if(isset($_POST['lname']) && !empty($_POST['lname'])){
		$user['lastname']= $_POST['lname'];
	}
	if(isset($_POST['fname']) && !empty($_POST['fname'])){
			$user['name']= $_POST['fname'];
	}
	if(isset($_POST['email']) && !empty($_POST['email'])){
			$user['email'] = $_POST['email'];
	}
	if(isset($_POST['gender']) && !empty($_POST['gender'])){
			$details['gender']= $_POST['gender'];
	}
	if(isset($_POST['address']) && !empty($_POST['address'])){
			$details['address']= $_POST['address'] ;
	}
	if(isset($_POST['education']) && !empty($_POST['education'])){
			$details['education']= $_POST['education'] ;
	}
	if(isset($_POST['skills']) && !empty($_POST['skills'])){
			$details['skills'] = $_POST['skills'];
	}

	if(isset($_FILES['profileimg'])){
		$image=$_FILES['profileimg'];
		if(!in_array($image['type'],$uplodeType)){
			echo '<script>alert("Sorry, only JPG, JPEG & PNG  files are allowed")</script>';
		}
		else if ($image['size']>500000){
			echo '<script>alert("Sorry, file size should be less then 500kb")</script>';
		}
		else{
			$target_dir = "assets/profile_img/";			
			$fileExtension = pathinfo($image['name'],PATHINFO_EXTENSION);
			$target_file = $target_dir .time().".".$fileExtension;
			/*"assets/profile_img/1234567.png"*/
			
			$fileuploded = move_uploaded_file($image['tmp_name'],$target_file);
			if($fileuploded){
				$details['profile_img']=$target_file;
			}
		}
	}
	if($error==0){
		if(isset($user) && ! empty($user)){				
		updateInDB($user,'users',['id'=>$user_id]);
		}
	
	 $checkUserData = checkUserExistOrNot(['user_id'=>$user_id],$table='user_details');
	 if($checkUserData){
		 updateInDB($details,'user_details',['user_id'=>$user_id]);
	 }
	 else{		 
		$details['user_id']=$user_id;
      makeInsertQuery($details,'user_details');
	 }
	 $user='';
	 $details='';
	header('location:profile.php');
	}

}