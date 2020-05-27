<?php
ob_start();
session_start();
$pagetitle="ResetPassword";
include "ini.php";
/**********************************************************************************************/
    //do
    $do=" ";
if(isset($_GET['do'])){
    $do =$_GET['do'];
}else{
    $do='resetPass';
}
/**************************************************************************************************************/
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if(isset($_POST['reset-request-submit'])){
    $emailRest=$_POST['email'];
    $_SESSION['resetEmail']=$emailRest;
    $stmt =$con->prepare("SELECT
                                  *
                              FROM 
                                  users 
                              WHERE 
                                   Email=?
                             AND 
                                  GroupId=0
                             AND
                                 Ragestatus=1
                              ");
    $stmt->execute(array($emailRest));
    $gets=$stmt->fetch();
    $count=$stmt->rowCount();
if ($count >0){
    global $emailRest; 
    $username=$gets['Username']."ahmed";
    $filterUsers=filter_var($username,FILTER_SANITIZE_STRING);
    $vkeyreset=md5(time().$filterUsers);
                            require 'phpmailer/PHPMailerAutoload.php';
                        $mails = new PHPMailer;
                        $mails->Host="smtp.gmail.com";
                        $mails->Port =587;
                        $mails->SMTPAuth=true;
                        $mails->SMTPSecure='tls';
                        $mails->Username='aoucamp2020@gmail.com';
                        $mails->Password="aoucampaou2020";
                        $mails->isSMTP();
                        $mails->setFrom($emailRest);
                        $mails->addAddress($emailRest);
                        $mails->isHTML(true);
                        $mails->Subject="Reset Password";
                        $mails->Body="Reset Password: ".$vkeyreset;
                        
                        if(!$mails->send()){
                            echo "bad";
                        }else{
                                
                    $stmts=$con->prepare("UPDATE 
                                      users 
                                   SET 
                                      vkey=? 
                                   WHERE
                                      Email=?
                                   AND 
                                      GroupId=0
                                   AND
                                      Ragestatus=1
                                      ");
                    $stmts->execute(array($vkeyreset,$emailRest));
        
                            echo "congrats you are now send reset password  in Your Email";
                            header('location:resetpassword.php?do=confirmVkey');
                        }
         
    }else{
    echo "bad";
}//end count
 
     }//end reset
/**********************************************************************************************/
/**************************************************************************************************************/
     if(isset($_POST['confirm-em'])){
        $confirmfrominputp=$_POST['confirm-em']; 
     }
    
    if(isset($_POST['confirmp'])){
        global $confirmfrominputp;
        $emailRestnew=$_SESSION['resetEmail'];
        
               $stmtp =$con->prepare("SELECT
                                           *   
                                      FROM 
                                          users 
                                      WHERE 
                                           Email=?
                                      AND 
                                           GroupId=0
                                      AND
                                           Ragestatus=1
                                      ");
       $stmtp->execute(array($emailRestnew));
        $getsp=$stmtp->fetch();
       $countss=$stmtp->rowCount();
        
        if ($countss >0){
        $vkeyconfirm=$getsp['vkey'];
        
        if($confirmfrominputp==$vkeyconfirm){
           header('location:resetpassword.php?do=changepassword'); 
            
    
        }
            
            
    }else{
            echo "bad confirm";
        }
        //end count
        
    } //end confitrm     
/**********************************************************************************************/
/**************************************************************************************************************/
     if(isset($_POST['changepass'])){
         
          $passwordone=$_POST['password'];
          $passwordtwo=$_POST['password-again'];
                    //check password
            if(isset($passwordone)&& isset($passwordtwo)){
                if(empty($passwordone)){
                   $formError[]='the field password is empty';  
                }
            $pass1=sha1($passwordone);
            $pass2=sha1($passwordtwo);
                if($pass1 !== $pass2){
                  $formError[]='not match password';   
                }
           }
         
         if(empty($formError)){
             $emailRestnew=$_SESSION['resetEmail'];
                 $stmtsy=$con->prepare("UPDATE 
                                      users
                                   SET 
                                      password=?
                                   WHERE
                                      Email=?
                                   AND 
                                      GroupId=0
                                   AND
                                      Ragestatus=1
                                   ");
                    $stmtsy->execute(array(sha1($passwordone),$emailRestnew));
                    //echo  success Message
                     if($stmtsy){
                         $successMessage= "<div class='alert alert-success'>".$stmtsy->rowCount().'Recorded confirm/div>';
                         unset($_SESSION["resetEmail"]);
                         header('location:login.php');
                     }else{
                         echo "bad";
                          }
         }
         
     }
/**********************************************************************************************/
/**************************************************************************************************************/
    if(isset($_POST['resend'])){
    if(isset($_SESSION['resetEmail'])){
       $emailRest=$_SESSION['resetEmail'] ;
    }
    global $emailRest;
    $stmt =$con->prepare("SELECT
                                  *
                              FROM 
                                  users 
                              WHERE 
                                   Email=?
                              AND 
                                   GroupId=0
                              AND
                                  Ragestatus=1
                              ");
    $stmt->execute(array($emailRest));
    $gets=$stmt->fetch();
    $count=$stmt->rowCount();
if ($count >0){
    global $emailRest; 
    $username=$gets['Username']."ahmed";
    $filterUsers=filter_var($username,FILTER_SANITIZE_STRING);
    $vkeyreset=md5(time().$filterUsers);
                            require 'phpmailer/PHPMailerAutoload.php';
                        $mails = new PHPMailer;
                        $mails->Host="smtp.gmail.com";
                        $mails->Port =587;
                        $mails->SMTPAuth=true;
                        $mails->SMTPSecure='tls';
                        $mails->Username='aoucamp2020@gmail.com';
                        $mails->Password="aoucampaou2020";
                        $mails->isSMTP();
                        $mails->setFrom($emailRest);
                        $mails->addAddress($emailRest);
                        $mails->isHTML(true);
                        $mails->Subject="Display Username";
                        $mails->Body="Display Username: ".$vkeyreset;
                        
                        if(!$mails->send()){
                            echo "bad";
                        }else{
                                
                    $stmts=$con->prepare("UPDATE 
                                      users 
                                   SET 
                                      vkey=? 
                                   WHERE
                                       Email=?
                                   AND 
                                      GroupId=0
                                   AND
                                      Ragestatus=1");
                    $stmts->execute(array($vkeyreset,$emailRest));
        
                            echo "congrats you are now send Username in Your Email";
                            header('location:resetUsername.php?do=confirmVkey');
                        }
         
    }//end count
        
        
     }//end resend
/**************************************************************************************************************/ 
 /**********************************************************************************************/ 

}//end server
/**************************************************************************************************************/
?>
<?php
/**********************************************************************************************/
/**********************************************************************************************/
if($do=='resetPass'){//manage page
?>
<!------------------------------------------------------------------------------------------------------------->
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
<!-------------------------------------------------->
<div class="reset-password">
    <div class="container"> 
        <h2>Reset Your Password</h2>
        
        <form class="reset" action="<?php $_SERVER['PHP_SELF']?>" method="post"> 
        <input type="text" name="email" placeholder="Enter Your e-mail address">
            <button class="btn btn-primary" type="submit" name="reset-request-submit">Reset Password</button>
        </form>
        
       </div><!--end container-->
</div><!--end reset password-->
<!------------------------------------------------------------------------------------------------------------->
<?php
/**********************************************************************************************/
/**********************************************************************************************/
   }elseif($do=='confirmVkey'){
    ?>


    

    <div class="confirm-em">
    <div class="container">
        <h2>Write Code</h2>
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            
        <input type="text" name="confirm-em" class="form-control" required="required"/>
        <input class="btn btn-primary btn-block " name='confirmp' type="submit" value="confirm">
             </form>
        
                <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <input class="btn btn-primary btn-block " name='resend' type="submit" value="Resend Code">
        </form>
      </div>
  </div>

<?php
/**********************************************************************************************/
/**********************************************************************************************/
}elseif($do=='changepassword'){
 ?> 
<div class="change-pass text-center">
    <div class="container">
        <h2>Change Password</h2>
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                 <input class="form-control" type="password" autocomplete="new-password" minlength="4" name="password" placeholder="type your password" required>
                
            <input class="form-control" type="password" autocomplete="new-password" minlength="4"  name="password-again" placeholder="type a password again" required>
    <input class="btn btn-primary btn-block " name='changepass' type="submit" value="confirm">
    
</form>
     </div>
</div>

<?php
}
?>
<!------------------------------------------------------------------------------------------------------------->
<?php
include  $tp1."footer.php";
ob_end_flush();
?>