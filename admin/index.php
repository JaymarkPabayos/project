<?php 
require_once("../include/initialize.php");
  if(!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/login.php");
  }

  $user = New User();
  $singleuser = $user->single_user($_SESSION['ADMIN_USERID']);

$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
  case '' :
        // $title="Home"; 
    // $content='home.php'; 
    if ($singleuser->ROLE==='Staff') {
        # code...
      redirect('company/');

    } 
    break;  
  default :
      $title="Home"; 
}
require_once("theme/templates.php");
?>