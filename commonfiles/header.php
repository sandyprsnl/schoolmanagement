<?php session_start();
 require_once 'functions.php';
 if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
	 header('location:login.php');
 }
   $user_id = $_SESSION['user_id'];
	$getUserDetailsQuery = selectFromDB(["education","address","skills","profile_img","role","gender","contact"],'user_details',["user_id"=>$user_id]);
	$userDetails = getDateFromDb($getUserDetailsQuery);
		$getUserSchoolDetailsQuery = selectFromDB([ "class_id","subject_ids","teacher_id","roll_no","role_id"],'school_details',["user_id"=>$user_id]);
   $userSchoolDetails= getDateFromDb($getUserSchoolDetailsQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php
if(!isset($_SESSION['loginEmail']) || empty($_SESSION['loginEmail'])){
	header('location:../login.php');
}

$getLoggedInUserDataQuery="SELECT `email`,`name`,`lastname` FROM `users` WHERE `email`='".$_SESSION['loginEmail']."'";
$getLoggedInUserDataResult= mysqli_query($conn,$getLoggedInUserDataQuery);
if(mysqli_num_rows($getLoggedInUserDataResult)>0){
	$userData=mysqli_fetch_assoc($getLoggedInUserDataResult);
}

?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>