<?php
	require_once 'commonfiles/header.php';
			
$getRolesQuery = selectFromDB([ "id","name"],'roles',["id"=>$userSchoolDetails['role_id']]);
$userRoles= getDateFromDb($getRolesQuery);
print_r($userRoles);
  ?>
  <!-- Navbar -->
	<?php require_once "commonfiles/topnavbar.php"?>
 <!-- /.navbar -->

  <!-- Main Sidebar Container -->
	<?php require_once "commonfiles/sidenavbar.php"?>
  <!-- Content Wrapper. Contains page content -->
  

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		
           <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                      <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name= "fname" id="fname" placeholder="First Name" value="<?php echo (isset($userData['name']))? $userData['name']: '';?>">
                        </div>
						
						<label for="lname" class="col-sm-2 col-form-label">Last Name</label>
						<div class="col-sm-4">
                          <input type="text" class="form-control" name= "lname" id="lname" placeholder=" Last Name"value="<?php echo (isset($userData['lastname']))? $userData['lastname']: '';?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?php echo (isset($userData['email']))? $userData['email']: '';?>">
                        </div>
                      </div>
					  <div class="form-group row">
                        <label for="inputName2"  class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                         <div class="form-group">
						  <select class="form-control select2" name="gender" style="width: 100%;">						
							<option  value=''<?php if(!isset($userDetails['gender'])){echo 'selected';}?> >Select Gender</option>
							<option value="male" <?php if( isset($userDetails['gender']) && $userDetails['gender']=='male'){echo 'selected';}?>>Male</option>
							<option value="female" <?php if(isset($userDetails['gender']) &&$userDetails['gender']=='female'){echo 'selected';}?>>Female</option>
							<option value="other"<?php if(isset($userDetails['gender']) &&$userDetails['gender']=='other'){echo 'selected';}?>>Other</option>
						  </select>
						</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="address" id="inputExperience" placeholder="Address"><?php echo (isset($userDetails['address']))? $userDetails['address']: '';?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Education</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="education" id="inputExperience" placeholder="Education"><?php echo (isset($userDetails['education']))? $userDetails['education']: '';?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <textarea name="skills" class="form-control" id="inputExperience" placeholder="skills"><?php echo (isset($userDetails['skills']))? $userDetails['skills']: '';?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-5">
                          <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="profileimg" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                        </div>
					<div class="col-sm-5">
						<img class="img img-responsive" width=" 250px" height=" 250px" src="<?php 
                         echo (isset($userDetails['profile_img']))? $userDetails['profile_img']: '/assets/profile_img/profileimg.png' ?>" alt="profile img">
                        </div>
                      </div>
                      <div class="form-group row">
                      </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="updateprofile" class="btn btn-primary">Save changes</button>
            </div>
			
           </form>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--- profile update modal---->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
	require_once 'commonfiles/footer.php';
?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>

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

	if(isset($_FILES['profileimg']) && ($_FILES['profileimg']['error']===0)){
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
	redirect($_SERVER['REQUEST_URI']);	 
	}

}