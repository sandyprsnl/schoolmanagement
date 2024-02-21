<?php
	require_once 'commonfiles/header.php';
			

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
				<a  class="btn btn-success" href="/updateProfile.php?userid=<?php echo $user_id ?>">
                  Update Profile
                </a>
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

