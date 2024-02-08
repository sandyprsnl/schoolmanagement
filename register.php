<?php $pageTitle="Register";?>
<?php require_once "commonfiles/db.php"?>
<?php require_once "commonfiles/login-header.php"?>
<?php require_once "commonfiles/phpMailer/PHPMailer.php"?>
<?php require_once "commonfiles/phpMailer/SMTP.php"?>

<?php
	if(isset($_POST['register'])){
		$name= mysqli_real_escape_string($conn ,$_POST['name']);
		$email=mysqli_real_escape_string($conn ,$_POST['email']);
		$password=mysqli_real_escape_string($conn ,$_POST['pass']);
		$cpassword=$_POST['cpass'];
		$trms=(isset($_POST['trms']))?$_POST['trms']:'';
		$error=[];
		
		if(empty($name)){
			$error['name']="please fill name";		
		}
		elseif(empty($email)){
			$error['email']="please fill Email";
		}
		elseif(empty($password)){
			$error['password']="please fill Password";
		}
		elseif($password!==$cpassword){
			$error['cpassword']="Confirm password must be equal to password";
		}
		elseif(empty($trms)){
			$error['trms']="please agree Terms";
		}
		else{
			$checkEmailSQLQuery="SELECT `email` FROM `users` WHERE `email`='$email'";
			$checkEmailSQLResult= mysqli_query($conn,$checkEmailSQLQuery);
			if(mysqli_num_rows($checkEmailSQLResult)==0){
					
				$registerSQLQuery="INSERT INTO `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')";
				$registerSQLResult= mysqli_query($conn,$registerSQLQuery);
				if($registerSQLResult){
					$mail = new PHPMailer(true);
					// Server settings
    //$mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '797ab74371109a';                     // SMTP username
    $mail->Password   = '1a17f789bf7d1d';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    //$mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($email, $name);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('codinginfo@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<h1>"'.$name.'" Register successfully</h1>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

					
					
					
					
					$name='';
					$email='';
					$password='';
					$cpassword='';
					$trms='';
					?>
					<script>
					alert('User register Successfully');
					</script>
					<?php
    
				}
			}
			else{
				?>
					<script>
					alert('email allready exist please try other email');
					</script>
				<?php
			}
					
		}
		
	}








  ?>

<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
	  <p class="error"><?php if(isset($error)){ foreach($error as $error){echo $error;} }?></p>

      <form action="" method="post">
        <div class="input-group mb-3">
           <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" value="<?php if(isset($name)){ echo $name;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php if(isset($email)){ echo $email;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password" name="pass" value="<?php if(isset($password)){ echo $password;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpass" value="<?php if(isset($cpassword)){ echo $cpassword;} ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="trms" value="agree" name="trms" value="trms" <?php if(isset($trms) && !empty($trms)){ echo "checked";} ?> >
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<?php require_once "commonfiles/login-footer.php"?>