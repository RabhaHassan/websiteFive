<?php
ob_start();
session_start();
$pagetitle="Profile";
include "ini.php";
/**********************************************************************************************/
if(isset($_SESSION["USER"])){
    $userheader=$_SESSION["USER"];
    $getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
    $getUser->execute(array($sessionUser));
    $info=$getUser->fetch();
    $userid=$info['userID'];
/**********************************************************************************************/
    
if(isset($_GET['userid'])){
  $_SESSION['IDPROFILE']=$_GET['userid'];  
}
/**********************************************************************************************/
    //do
    $do=" ";
if(isset($_GET['do'])){
    $do =$_GET['do'];
}else{
    $do ="manage";
}
 /**********************************************************************************************/   
?>



<?php
if($do=="manage"){
?>   
<!------------------------------------------------>
        <div class="slider-blog text-center">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="layout/images/mercedes-benz-4603333_1920-1920x1000.jpg" alt="...">
              <div class="carousel-caption">
        <h3>FEATURED,LIFESTYLE,PHOTO</h3>
       <h2>I shouted above<br>
        the sudden
        noise.</h2>
                  
      <p>Through two long weeks I wandered, stumbling through the nights guided only by the stars and hiding during the days behind some protruding rock or among the occasional hills I traversed.</p>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/city-731296_1920-1920x1000.jpg" alt="...">
                      <div class="carousel-caption">
        <h3>FEATURED,LIFESTYLE,PHOTO</h3>
       <h2>I shouted above<br>
        the sudden
        noise.</h2>
                  
      <p>Through two long weeks I wandered, stumbling through the nights guided only by the stars and hiding during the days behind some protruding rock or among the occasional hills I traversed.</p>
      </div>
    </div>
      
          <div class="item">
      <img src="layout/images/mercedes-benz-4603333_1920-1920x1000.jpg" alt="...">
                            <div class="carousel-caption">
        <h3>FEATURED,LIFESTYLE,PHOTO</h3>
       <h2>I shouted above<br>
        the sudden
        noise.</h2>
                  
      <p>Through two long weeks I wandered, stumbling through the nights guided only by the stars and hiding during the days behind some protruding rock or among the occasional hills I traversed.</p>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
          </div><!--end slider blog-->
<!---------------------------------------------------->
<h1 class="text-center">My Profile</h1>
<div class="information">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Information</div>
            <div class="panel-body">
                <ul class="list-unstyled">
                 <li>
                     <i class="fa fa-unlock-alt fa-fw"></i>
                     <span>Login Name:</span><?php echo $info['Username'] ?> 
                    </li>
                    <li> 
                        <i class="fa fa-envelope fa-fw"></i>
                        <span>Email:</span><?php echo $info['Email'] ?>
                    </li>
                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>FullName:</span><?php echo $info['Fullname'] ?>
                    </li>
                    <li>
                        <i class="fa fa-calendar fa-fw"></i>
                        <span>Register Date:</span><?php echo $info['Date'] ?>
                    </li>
                </ul>
                <a href="editprofile.php?userid=<?php echo $info['userID']; ?>" class="btn btn-default">Edit Information</a>
                <a href="removeaccount.php?userid=<?php echo $info['userID']; ?>" class="btn btn-default confirm">Delete Account</a>
                
                <!---
                <a href="stopaccount.php?userid=" class="btn btn-default confirm">Temporary Account</a>
-->
            </div><!--end panel body-->
         </div><!--end panel primary-->
     </div><!--end container-->
</div><!--end information-->
<!------------------------------------------------>
<?php  
/////////////////////////////////////////////////////////////////////////////////////////
}
?>
<!------------------------------------------------>
<?php
}else{
    header('Location:login.php');
    exit;
}
include  $tp1."footer.php";
ob_end_flush();
?>