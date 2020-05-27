<?php
ob_start();
session_start();
$pagetitle="ResetUsername";
include "ini.php";
    //do
    $do=" ";
if(isset($_GET['do'])){
    $do =$_GET['do'];
}else{
    $do='resetuser';
}
/**************************************************************************************************************/
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    
if(isset($_POST['reset-request-username'])){
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
                        $mails->Subject="for confirm";
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
        
                            echo "congrats you are now send reset password  in Your Email";
                            header('location:resetUsername.php?do=confirmVkey');
                        }
         
    }     
        
     }//end reset
/**************************************************************************************************************/
    if(isset($_POST['confirm-em'])){
        $confirmfrominputp=$_POST['confirm-em']; 
     }
    
    if(isset($_POST['confirmu'])){
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
           header('location:resetUsername.php?do=displayUser'); 
            
    
        }
            
            
    }else{
            echo "bad confirm";
        }
        //end count
        
    } //end confitrm 
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
                                      WHERE Email=?");
                    $stmts->execute(array($vkeyreset,$emailRest));
        
                            echo "congrats you are now send Username in Your Email";
                            header('location:resetUsername.php?do=confirmVkey');
                        }
         
    }//end count
        
        
     }//end resend
/**************************************************************************************************************/
}
    


?>
<!------------------------------------------------------------------------------------------------------------->
<?php
/**********************************************************************************************/
/**********************************************************************************************/
if($do=='resetuser'){//manage page
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
<!--------------------------------------------------->
<div class="reset-username">
    <div class="container"> 
        <h2>Reset Your Username</h2>
        
        <form class="reset" action="<?php $_SERVER['PHP_SELF']?>" method="post"> 
        <input type="text" name="email" placeholder="Enter Your e-mail address">
            <button class="btn btn-primary" type="submit" name="reset-request-username">Recover Username</button>
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
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            
        <input type="text" name="confirm-em" class="form-control" required="required"/>
        <input class="btn btn-primary btn-block " name='confirmu' type="submit" value="confirm">
             </form>
        
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <input class="btn btn-primary btn-block " name='resend' type="submit" value="Resend Code">
        </form>
      </div>
  </div>
<?php
/**********************************************************************************************/
/**********************************************************************************************/
}elseif($do=='displayUser'){
    $emailRestnew=$_SESSION['resetEmail'];
        $stmtu =$con->prepare("SELECT
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
       $stmtu->execute(array($emailRestnew));
        $getsu=$stmtu->fetch();
       $countsu=$stmtu->rowCount();
        
        if ($countsu >0){
            $disuser=$getsu['Username'];
        }
?>
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
<div class="diplay">
    <div class="container">
        <p>
            <?php
               global $disuser;
             echo "The Username: ".$disuser;
            ?>
        </p>
      </div><!--end container-->
</div>
<?php
}
?>
<!------------------------------------------------------------------------------------------------------------->
<?php
include  $tp1."footer.php";
ob_end_flush();
?>