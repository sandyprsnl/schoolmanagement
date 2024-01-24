<?php $pageTitle="Login";?>
<?php require_once "commonfiles/login-header.php"?>

<?php
if(isset($_SESSION['loginEmail']) || !empty($_SESSION['loginEmail'])){
	header('location:index.php');
}
	if(isset($_POST['login'])){
		$email=mysqli_real_escape_string($conn ,$_POST['email']);
		$password=mysqli_real_escape_string($conn ,$_POST['pass']);
		$error=[];
		
		if(empty($email)){
			$error['email']="please fill Email";
		}
		else if(empty($password)){
			$error['password']="please fill Password";
		}
		else{
			$loginSQLQuery = "SELECT `email`,`id`,`isActive` FROM `users` WHERE `email`='$email' AND `password`=$password";
			$loginSQLResult = mysqli_query($conn,$loginSQLQuery);
			if(mysqli_num_rows($loginSQLResult)>0){				
				$sqlDataArray = mysqli_fetch_assoc($loginSQLResult);
				if($sqlDataArray['isActive']){					
				$_SESSION['loginEmail'] = $sqlDataArray['email'];
				$_SESSION['user_id'] = $sqlDataArray['id'];
					header('location:index.php');
				}else{
					$error['userNotActive'] = "your account not active please contact administration";
				}
				
			}else{
				
				$error['userNotExist']= "User Not Found";
			}
					
		}
		
	}
?>

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
	  <?php 
	  if(!empty($error)){
	  foreach($error as $key=> $errorVal) { ?>
	  <p style="color:red; text-align:center;"><?php echo $errorVal ; ?></p>
	  
	<?php  }
	  }
	?>
      <form action="" method="post">
        <div class="input-group mb-3"  style="<?php if(isset($error['email'])){echo 'border-color:red';}?>">
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php if(isset($email)){ echo $email;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" style="<?php if(isset($error['password'])){echo 'border-color:red';}?>">
          <input type="password" class="form-control" id="password" placeholder="Password" name="pass" value="<?php if(isset($password)){ echo $password;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<?php require_once "commonfiles/login-footer.php"?>
