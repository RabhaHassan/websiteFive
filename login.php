<?php
ob_start();
session_start();
$pagetitle="Login";
if(isset($_SESSION["USER"])){
  header('location:index.php');  
};
include "ini.php";
/**************************************************************************************************************************************/
//database
   if($_SERVER['REQUEST_METHOD']=='POST'){
       
       if(isset($_POST['login'])){
           
      
       $user=$_POST['username'];
       $pass=$_POST['password'];
       $hashpass=sha1($pass);
       
       //check if  the user exits  in databases
       $stmt =$con->prepare("SELECT
                                  userID,Username,password,Ragestatus,Email
                              FROM 
                                  users 
                              WHERE 
                                   Username=? 
                              AND 
                                   password=? 
                              AND
                                   GroupID=0
                              ");
       $stmt->execute(array($user,$hashpass));
        $get=$stmt->fetch();
       $count=$stmt->rowCount();
        $ragestatus=$get['Ragestatus'];
        $passchecks=$get['password'];
        $emailCheck=$get['Email'];
/**************************************************************************************************************************************/   
       //if count >0 this mean database contain  record about username
       if ($count >0){
           global $ragestatus;
           $userfromlogin=$get['Username'];
           

           if($ragestatus ==1){
               
           $_SESSION["USER"]=$user; //register session name;
           $_SESSION["UID"]=$get['userID']; //register session id;
           header('location:index.php');
           exit(); 
               
           }else{
               
            global $get;
           global $user;
            global $pass;
            global $passchecks;
           global $ragestatus;
           global $userfromlogin;
             ///////////////////////////////////  
           if(($user==$userfromlogin)&&($passchecks ==$hashpass)){
             $_SESSION["UIDconfirm"]=$get['userID']; //register session id;  
               if($ragestatus==0){
               header('location:confirmemail.php');
              }
               
               
           }else{
                   $successMessage="the username or password Wrong";
               } 
               
               
           /////////////////////////////////////    
           }
           //status
           
           

       }else{
                    $themessge= "<div class='alert alert-danger'>sorry Try Again</div>";
                    redirectHome($themessge,'back');
       }
           
           
           
            }else{//else login
/**************************************************************************************************************************************/ 
           
 
           
        
/**************************************************************************************************************************************/        
           $formError=array();
           global $emailCheck;
           $username=$_POST['username'];
           $passwordone=$_POST['password'];
           $passwordtwo=$_POST['password-again'];
           $email=$_POST['email'];
           
           //check username
           if(isset($username)){
              $filterUser=filter_var($username,FILTER_SANITIZE_STRING);
               
               if(strlen($filterUser)<4){
                 $formError[]='Username Must be than 4 characters';  
               }
           }
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
           //check email
                if(isset($email)){
              $filterEmail=filter_var($email,FILTER_SANITIZE_EMAIL);
               if(filter_var($filterEmail,FILTER_VALIDATE_EMAIL !=true)){//if not email
                   $formError[]='this  email  is not valid'; 
               }
                //loop
                        global $con;
                    $getAll=$con->prepare("SELECT Email FROM users");
                    $getAll->execute();
                    $allusers=$getAll->fetchAll();
                foreach($allusers as $userch){//all items
               if($email==$userch['Email']){
                  $formError[]='this  email  is unavailable'; 
               }
                }
              //
                    
           }
           
/**************************************************************************************************************************************/
           //check is not exits errors
                 if(empty($formError)){
                //Insert  the database with  this info is not exist unsername 
                //*********************************************************************************
                  global $username;
                  global $email;
                  $filterUsers=filter_var($username,FILTER_SANITIZE_STRING);
                  $vkey=md5(time().$filterUsers); 
                    $stmt=$con->prepare("INSERT INTO 
                                                users(Username,password,Email,vkey,Ragestatus,Date)
                                                VALUES(:zusername,:zpassword,:zemail,:zvkey,0,now())");
                    $stmt->execute(array(
                        'zusername' =>$username,
                        'zpassword' =>sha1($passwordone),
                        'zemail'    =>$email,
                        'zvkey'   =>$vkey
                        
                    ));
                     
                    //send confirm
                    if($stmt){
                        require 'phpmailer/PHPMailerAutoload.php';
                        $mail=new PHPMailer;
                        $mail->Host="smtp.gmail.com";
                        $mail->Port =587;
                        $mail->SMTPAuth=true;
                        $mail->SMTPSecure='tls';
                        $mails->Username='aoucamp2020@gmail.com';
                        $mails->Password="aoucampaou2020";
                        $mail->isSMTP();
                        $mail->setFrom($email);
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject="for confirm";
                        $mail->Body=$vkey;
                        
                        if(!$mail->send()){
                            echo "<h1>"."bad"."</h1>";
                        }else{
                            
                            echo "congrats you are now send confirm  in Your Email";
                        }
                        $_SESSION["Emailconfirm"]=$email;
                       $successMessage="congrats you are now register in website"; 
                       header("location:confirmemail.php");
                        }//end stmt
                     
                          /*
                    }//end if check the username
                             */
            }//end if error 

       }//end if check login or sign up
   }//end if request
/**************************************************************************************************************************************/
?>
<!--------------------------------------------------->
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
<div class="login-page">
    <div class="container">
                <h1 class="text-center">
            <span class="selected" data-class="login"><?php echo lang('Login');?></span> | 
            <span data-class="signup"><?php echo lang('SignUp');?></span></h1>
<!--------------------------------------------------------------------------------------------------------------------------------->
        <!--start login form-->
        <form class="login" action="<?php $_SERVER['PHP_SELF']?>" method="post">    
            <div class="input-container">
            <input class="form-control" type="text" autocomplete="off" name="username" placeholder="Type yur username" required>
                </div><!--end input container-->
            <div class="input-container">
             <input class="form-control" type="password" autocomplete="new-password" name="password" placeholder="type your password" required>
                </div><!--end input container-->
            <input class="btn btn-primary btn-block " name='login' type="submit" value="Login">
        <a href="resetpassword.php?do=resetPass">Forget Password   </a>
        <a href="resetUsername.php?do=resetuser">Forget Username</a> 
         </form>

             <!--end login form-->
<!--------------------------------------------------------------------------------------------------------------------------------->
        <!--start signup form-->
            <form class="signup" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <div class="input-container">
            <input class="form-control" type="text" autocomplete="off" name="username" placeholder="Type yur username" pattern=".{4,}"
            title=" the username betwwen 4char" required>
                    </div><!--end input container-->
                                    <div class="input-container">
            <input class="form-control" type="email" autocomplete="off" name="email" placeholder="type your email" required>
                    </div><!--end input container-->
                   <div class="input-container">
             <input class="form-control" type="password" autocomplete="new-password" minlength="4" name="password" placeholder="type your password" required>
                    </div><!--end input container-->
                    <div class="input-container">
            <input class="form-control" type="password" autocomplete="new-password" minlength="4"  name="password-again" placeholder="type a password again" required>
                    </div><!--end input container-->

            <input class="btn btn-success btn-block " name="signup" type="submit" value="Signup">
         </form>
        <!--end signup form-->
<!--------------------------------------------------------------------------------------------------------------------------------->


<!-------------------------------------------------------------------------------------------------------------------------------->
        <div class="test-error text-center">
        <?php 
    if(!empty($formError)){
      foreach($formError as $errors){
          echo $errors."</br>";
      }
    
    }
    if(isset($successMessage)){
        echo "<div class=''>".$successMessage."<?div>";
        
    }
    
            ?>
         </div><!--end test-error-->
     </div><!--end container-->
 </div><!--end login-->
<!---------------------------------------------------------------------------------------------------------------------------------> 
    
      
<?php 
include  $tp1."footer.php";
ob_end_flush();
?>
