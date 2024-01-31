<?php
	require_once 'commonfiles/header.php';
  $user_id = $_SESSION['user_id'];
	$getUserDetailsQuery = selectFromDB(["education","address","skills","profile_img","role","gender","contact"],'user_details',["user_id"=>$user_id]);
	$userDetails = getDateFromDb($getUserDetailsQuery);
			
	$getUserSchoolDetailsQuery = selectFromDB([ "class_id","subject_ids","teacher_id","roll_no","role_id"],'school_details',["user_id"=>$user_id]);
   $userSchoolDetails= getDateFromDb($getUserSchoolDetailsQuery);
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php 
                         echo (isset($userDetails['profile_img']))? $userDetails['profile_img']: '/assets/profile_img/profileimg.png' ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php 
				if( isset($userBasicDetails['name']) ){
					echo $userBasicDetails['name']. " ".(isset($userBasicDetails['lastname']))? $userBasicDetails['lastname']: '';
				}
					
				?></h3>

                <p class="text-muted text-center"><?php 
				 echo (isset($userDetails['role']))? $userDetails['role']: 'No Roll Assign Yet';
				?></p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                  Update Profile
                </button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  			  <strong><i class="fa fa-male mr-1"></i> Gender</strong>

                <p class="text-muted">
                 <?php 
				 echo (isset($userDetails['gender']))? ucfirst($userDetails['gender']): 'Not choose';
				?>
                </p>
			  <strong><i class="fas fa-book mr-1"></i> Class</strong>

                <p class="text-muted">
                 <?php 
				 echo (isset($userSchoolDetails['class']))?ucfirst( $userSchoolDetails['class']): 'Not assign';
				?>
                </p>
				<hr>
				<strong><i class="fas fa-book mr-1"></i> Subjects</strong>
				<p class="text-muted">
                   <?php 
				 echo (isset($userSchoolDetails['subjects']))? ucfirst($userSchoolDetails['subjects']): 'Not assign';
				?>
                </p>
				<hr>
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                   <?php 
				 echo (isset($userDetails['education']))? ucfirst($userDetails['education']): 'Not Assign';
				?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                <p class="text-muted"><?php 
				 echo (isset($userDetails['address']))? $userDetails['address']: 'Not choose';
				?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                 <?php 
				 echo (isset($userDetails['skills']))? $userDetails['skills']: 'Not choose';
				?>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--- profile update modal---->
  
<?php require_once "assets/phpfiles/updateProfile.php"?>
  <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
           <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Update Profile</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
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
							<option value="male" <?php if($userDetails['gender']=='male'){echo 'selected';}?>>Male</option>
							<option value="female" <?php if($userDetails['gender']=='female'){echo 'selected';}?>>Female</option>
							<option value="other"<?php if($userDetails['gender']=='other'){echo 'selected';}?>>Other</option>
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
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  <!--- profile update modal end---->  
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