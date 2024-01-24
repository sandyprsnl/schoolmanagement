<?php

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
	$check= updateInDB($user,'users',['id'=>$user_id]);
		
	 $checkUserData = checkUserExistOrNot(['user_id'=>$user_id],$table='user_details');
	 if($checkUserData){
		 updateInDB($details,'user_details',['user_id'=>$user_id]);
	 }
	 else{		 
		$details['user_id']=$user_id;
      makeInsertQuery($details,'user_details');
	 }
	
	
	
	
	
	//$file= $_FILE['profileimg'];
}