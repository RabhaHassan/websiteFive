<?php
session_start();
$nonavbar=" ";
$pagetitle="Login";
if(isset($_SESSION["USERNAME"])){
  header('location:dashboard.php');  
};
include "ini.php";
//database
   if($_SERVER['REQUEST_METHOD']=='POST'){
       $username=$_POST['user'];
       $password=$_POST['pass'];
       $hashpass=sha1($password);
       
       //check if  the user exits  in databases
       $stmt =$con->prepare("SELECT
                              userID,Username,password 
                              FROM 
                                  users 
                              WHERE 
                                   Username=? 
                              AND 
                                   password=? 
                              AND
                                   GroupID=1
                              LIMIT 1");
       $stmt->execute(array($username,$hashpass));
       $row=$stmt->fetch();//get information in array
       $count=$stmt->rowCount();
       
       //if count >0 this mean database contain  record about username
       if ($count >0){
           $_SESSION["USERNAME"]=$username; //register session name;
           $_SESSION["ID"]=$row['userID']; //register session userid;
           header('location:dashboard.php');
           exit();
       }
   }
?>
<!--------------------------------------------------------form--------------------------------->
<form class="login" action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <h4 class="text-center">Admin Login</h4>
      <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off"/>
      <input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password">
      <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
</form>
<?php include  $tp1."footer.php"?>