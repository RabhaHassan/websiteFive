<?php
ob_start();
//
if(!isset($_SESSION['lang'])){
    $_SESSION['lang']="en";
}
  include "includes/languages/".$_SESSION['lang'].".php";  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_SESSION["USER"])){
 $userheader=$_SESSION["USER"];
$idheader=$_SESSION["UID"];   
global $idheader;
       //check if  the user exits  in databases
       $stmt =$con->prepare("SELECT
                                  userID,Username,password,avatar
                              FROM 
                                  users 
                              WHERE 
                                   Username=? 
                             And  GroupID=0
                                   
                              ");
       $stmt->execute(array($userheader));
        $get=$stmt->fetch();
       $count=$stmt->rowCount();
    //search 
           //check if  the user exits  in databases
       $stmt3 =$con->prepare("SELECT
                                  *
                              FROM 
                                  items 
                              WHERE 
                                   Member_ID=? 
                                   
                              ");
       $stmt3->execute(array($idheader));
        $itemS=$stmt3->fetch();
       $count=$stmt->rowCount();
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width"   charset="utf-8">
    <title><?php echo gettitle();?></title>
    <link rel="stylesheet" href="<?php echo $css?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $css?>jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo $css?>bootstrap.css">
    <link rel="stylesheet" href="<?php echo $css?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $css?>front.css">
    <link rel="stylesheet" href="<?php echo $css?>responsive.css">
    </head>
    <body>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="top-nav navbar-fixed-top">
            <div class="container">
                <div class="all-nav">
                <div class="row">
                    <div class="right-top-nav">
                        
                <div class="col-md-6">
   <div class="control-navbar">
<div class="container">
       <div class="row">
           <div class="col-md-12">
                   <nav class="navbar navbar-inverse ">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php"><?php echo lang('HOME_PAGE');?></a></li>
        <li><a href="posts.php"><?php echo lang('products');?></a></li>
      </ul>
        
        
              <ul class="nav navbar-nav navbar-right">
                  <div class="upper-bar">
  <?php if($pagetitle =="Home" or $pagetitle =="Products" ){?>                               
<div class="search">
    <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input placeholder="Title Post Only" type="text" name="search" >
        <i class="fa fa-search" aria-hidden="true"></i>
    <input class="hidden" type="submit" >
    </form>
</div><!--end search-->
<?php }?>      
        <!-------------------------------------------->
                <?php
               if(isset($userheader)){?>
                <?php
                  if(!empty($get['avatar'])){
                    echo "<img class='img-circle img-thumbnail' src='uploads/profiles/".$get['avatar']."'alt=''/>";
                  }else{
                      echo "<img class='img-circle img-thumbnail' src='img-1.png'/>";
                  }
                ?>
                
                
                <div class="btn-group my-info">
                    <span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php echo $userheader;?>
                        <span class="caret"></span>
                     </span><!--end btn dropdwon-->
                    <ul class="dropdown-menu">
                        <?php global $idheader;?>
                        <li><a href="profile.php?do=manage"><?php echo lang('My_profile');?></a></li>
                        <li><a href="newpost.php">Add Post</a></li>
                        <li><a href="logout.php"><?php echo lang('Log_out');?></a></li>
                        
                        
                     </ul><!--end dropdown menue-->
                    <!--end notification------------------------->
                    
                   </div><!--end btn-group-->
<!-------------------------------------------------------------------------------------------------------------------------------------->
                <?php
                 }else{
                      ?>
               <a href="login.php" class="login">
                <span class="pull-right login-sign"><?php echo lang('login_signup');?><i class="fa fa-sign-in" aria-hidden="true"></i></span>
                </a>
                <?php } ?>

            
          </div><!--end upper bar-->
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
           
           </div><!--end col-md-10-->
         </div><!--end row-->
       </div><!--end container-->
       </div><!--end control navbar-->
                    </div>
                        
   
                <!------------------------------->
                    <div class="col-md-6">
           
                    </div>
                    </div><!--end top nav-->
                </div><!--end row-->
                    </div><!--all nav-->
             </div><!--end container-->
        </div><!--end top-nav-->
          <!-------------------------------------------->      
<!--------------------------------------------------------------------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------------------------------>
<?php
ob_end_flush();
?>