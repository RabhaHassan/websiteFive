<?php
ob_start();
session_start();
$pagetitle="Confirm";
include "ini.php";
/*************************************************************************************************************/
/*************************************************************************************************************/
if(isset($_SESSION["Emailconfirm"])){
    $confirmEmail=$_SESSION["Emailconfirm"];
}else{
    $stmt =$con->prepare("SELECT
                                           *
                              FROM 
                                  users 
                          WHERE 
                                   userID=?
                              ");
   $stmt->execute(array($_SESSION["UIDconfirm"]));
        $gets=$stmt->fetchALL();
   foreach($gets as $get){
      $confirmEmail=$get["Email"]; 
   }//end foreach
}//end if emailconfirm
/*************************************************************************************************************/
/*************************************************************************************************************/


if(isset($_SESSION["UIDconfirm"])){
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if(isset($_POST['confirm'])){
        $confirmfrominput=$_POST['confirm-em'];
               $stmt =$con->prepare("SELECT
                                           *
                              FROM 
                                  users 
                          WHERE 
                                   Email=?
                              ");
   $stmt->execute(array($confirmEmail));
        $gets=$stmt->fetch();
   $count=$stmt->rowCount();
    if ($count >0){
        $vkeyconfirm=$gets['vkey'];
      $_SESSION["USER"]=$gets['Username'];
      $_SESSION["UID"]=$gets['userID'];
        if($confirmfrominput==$vkeyconfirm){
                           $stmts=$con->prepare("UPDATE 
                                      users
                                   SET 
                                   Ragestatus=1
                                      WHERE Email=?");
                    $stmts->execute(array($confirmEmail));
                    //echo  success Message
                     if($stmts){
                         $successMessage= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded confirm/div>';
                         unset($_SESSION["Emailconfirm"]);
                         header('location:index.php');
                     }else{
                         unset($_SESSION["USER"]);
                         unset( $_SESSION["UID"]);
                         echo "bad";
                          }//end else if stmt
        }//end if check email
    }//end if count
    }//in if post confirm
    
    
/*************************************************************************************************************/
/**************************************************************************************************************/
    
    
if(isset($_POST['resend'])){
    
    if(isset($_SESSION['resetEmail'])){
       $emailRest=$_SESSION['UIDconfirm'] ;
    }else{
        $emailRest=$_SESSION['UIDconfirm'] ;
    }

    global $emailRest;
    $stmt =$con->prepare("SELECT
                                  *
                              FROM 
                                  users 
                              WHERE 
                                   userID=?
                              AND 
                                  GroupId=0
                             AND
                                 Ragestatus=0
                              ");
    $stmt->execute(array($emailRest));
    $gets=$stmt->fetch();
    $countt=$stmt->rowCount();
    echo $countt;
    echo $emailRest;
if ($countt >0){
    global $emailRest; 
    $username=$gets['Username']."ahmed";
    $emailSend=$gets['Email'];
    $filterUsers=filter_var($username,FILTER_SANITIZE_STRING);
    $vkeyreset=md5(time().$filterUsers);
    echo $vkeyreset;
                            require 'phpmailer/PHPMailerAutoload.php';
                        $mails = new PHPMailer;
                        $mails->Host="smtp.gmail.com";
                        $mails->Port =587;
                        $mails->SMTPAuth=true;
                        $mails->SMTPSecure='tls';
                        $mails->Username='aoucamp2020@gmail.com';
                        $mails->Password="aoucampaou2020";
                        $mails->isSMTP();
                        $mails->setFrom($emailSend);
                        $mails->addAddress($emailSend);
                        $mails->isHTML(true);
                        $mails->Subject="Display Code";
                        $mails->Body="Display Code: ".$vkeyreset;
                        
                        if(!$mails->send()){
                            echo "bads";
                        }else{
                                
                    $stmts=$con->prepare("UPDATE 
                                      users 
                                   SET 
                                      vkey=? 
                                      WHERE userID=?");
                    $stmts->execute(array($vkeyreset,$emailRest));
        
                            echo "congrats you are now send Username in Your Email";
                            header('location:confirmemail.php?do=confirmVkey');
                        }
         
    }else{//end count
       echo "bad"; 
        }//end else
     }//end resend
    }//end if server
/**************************************************************************************************************/
/*************************************************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
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
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<div class="confirm-em">
    <div class="container">
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            
        <input type="text" name="confirm-em" class="form-control" required="required" placeholder="Write Code"/>
        <input class="btn btn-primary btn-block " name='confirm' type="submit" value="confirm">
        
             </form>
        
        <form class="confirms" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <input class="btn btn-primary btn-block " name='resend' type="submit" value="Resend Code">
        </form>
      </div>
  </div>
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<?php
}else{
    header('Location:login.php');
    exit;
}
include  $tp1."footer.php";
ob_end_flush();
?>