
<?php
ob_start();
session_start();
$pagetitle="DeleteAcount";//title page by function 
  include "ini.php";
/**********************************************************************************************/
?>
<?php
/**********************************************************************************************/
if(isset($_SESSION["USER"])){

                if(isset($_GET['userid'])&&is_numeric($_GET['userid'])){
                     $userId=intval($_GET['userid']);
                      $check =checkItem("userID","users",$userId);  
                 }//end if check
                if($check >0){
                    $stmt3=$con->prepare("select * FROM users WHERE userID=?");
                    $stmt3->execute(array($userId));
                    $counts=$stmt3->rowCount();
                    if($counts>0){
                     $user=$stmt3->fetch();
                    }
                    /////////////////////////////////////////////////Items
                    $stmt5=$con->prepare("select * FROM  items WHERE Member_ID=?");
                    $stmt5->execute(array($userId));
                    $countsss=$stmt5->rowCount();

                    
                    
                    $stmt=$con->prepare("DELETE FROM users WHERE userID=?");
                    $stmt->execute(array($userId));
                    $themessge="<div class='alert alert-success'>".$stmt->rowCount().'Recorded deleted</div>';
                   unset($_SESSION["USER"]);
                    unset($_SESSION["UID"]);
                    redirectHome($themessge);

                }else{
                    
                    $themessge= "<div class='alert alert-danger'>This ID is not exist</div>";
                    redirectHome($themessge);
                    
    
                }
/**********************************************************************************************/
/**********************************************************************************************/
?>
    
<?php
}else{
    header('Location:login.php');
    exit;
}
include  $tp1."footer.php";
ob_end_flush();
?>