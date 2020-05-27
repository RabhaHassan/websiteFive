<?php
ob_start();//output buffering  start 
session_start();
$pagetitle="Dashboard";
if(isset($_SESSION["USERNAME"])){
  include "ini.php";
//start dashboard  page

    ?>
<!--start------->
<div class="home-state text-center">
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
                <div class="state st-members">
                  <i class="fa fa-users"></i>  
                    <div class="info">
                 Total members
                <span><a href='members.php'><?php echo countItem("userID","users")?></a></span>
             </div>
             </div><!--end state-->
        </div>
            <!----------------------->
                    <div class="col-md-3">
            <div class="state st-pending">
                <i class="fa fa-user-plus"></i>
           <div class="info">
                    Pending members
                <span><a href='members.php?do=Manage&page=pending'><?php echo checkItem("Ragestatus","users",0);?></a></span>
                 </div>
             </div><!--end state-->
        </div>
            <!----------------------->
                   <div class="col-md-3">
            <div class="state st-items">
                <i class="fa fa-tag"></i>
               <div class="info">
                                   Total Posts
                <span><a href='posts.php'><?php echo countItem("Item_ID","items")?></a></span>
                 </div>
             </div><!--end state-->
        </div>
            <!----------------------->

       </div><!--end row-->
  </div><!--end container-->
            </div><!--end home-state-->
<!--------------------------------------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------------------------------------------------------------------------------------------------->
<?php
//end dashboard page
  include  $tp1."footer.php";
}else{
    header('location:index.php');  
    exit();
}
ob_end_flush();
?>