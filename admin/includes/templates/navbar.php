<?php
if(isset($_SESSION["USERNAME"])){
}else{
    header('location:index.php');  
}
?>
<div class="container">
<div class="row">
<div class="col-md-3">
  <button class="openbtn" onclick="openNav()">☰ Menue</button>  
</div>
<div class="col-md-9">
   <nav class="navbar navbar-inverse">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["USERNAME"];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../index.php">Visit Blog</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
   
  </div><!-- /.container-fluid -->
</nav> 
   
</div>
</div>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="dashboard.php"><?php echo  lang('HOME_ADMIN');?></a>
  <a href="posts.php"><?php echo  lang('ITEMS');?></a>
  <a href="members.php"><?php echo  lang('MEMBERS');?></a>

</div>