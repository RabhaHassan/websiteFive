<?php
ob_start();
session_start();
$pagetitle="Edit Profile";
include "ini.php";
/*************************************************************************************************************/
/*************************************************************************************************************/
//unset($_SESSION['IDPROFILE']);
if(isset($_GET['userid'])){
  $_SESSION['IDPROFILE']=$_GET['userid'];  
}
/*************************************************************************************************************/
/*************************************************************************************************************/
//insert
if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_POST['useridp'];
        $_SESSION['IDPROFILE']=$id;
        $formErrors=array();
    
        $user  =filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email  =filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $fulln =filter_var($_POST['fullname'],FILTER_SANITIZE_STRING);

                $pass="";
                if(empty($_POST['newpassword'])){
                  $pass= $_POST['oldpassword']; 
                }else{
                    $pass=sha1($_POST['newpassword']);
                }
        //////////////////////////update///////////////////////////////////////////////////////    
        //check if error in form 
        if(empty($formerror)){//only it'snot exist error
            
               $stmt=$con->prepare("UPDATE 
                                      users
                                   SET 
                                      Username=?,
                                      Email=?,
                                      password=?,
                                      Fullname=?,
                                      Ragestatus=?
                                      WHERE userID=?");
                    $stmt->execute(array($user,$email,$pass,$fulln,1,$id));
                    //echo  success Message
                     if($stmt){
                          $successMessage= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Inserted</div>'; 
                         echo "<script>window.open('editprofile.php?useridr=$idheader','_self')</script>"; 
                     }else{
                         echo "bad";
                          }
                     
                    }//end if error 
      //////////////////////////////////////////////////////////////////////////////////////////////////
    
        //ERRORS
                $formerror=array();
                if(strlen($user)<4){
                  $formerror[]="<div class='alert alert-danger'>username can't be less four letters</div>";   
                }
                if(strlen($user)>20){
                  $formerror[]="<div class='alert alert-danger'> username can't be than 20 letters</div>";   
                }
                if(empty($user)){
                 $formerror[]=" <div class='alert alert-danger'>username can't be empty</div>";   
                }
                if(empty($email)){
                 $formerror[]="<div class='alert alert-danger'>Email can't be empty</div>";   
                }
                if(empty($fulln)){
                 $formerror[]="<div class='alert alert-danger'>Fullname can't be empty</div>";   
                }
                //Insert  the database with  this info is not exist unsername 
                //*********************************************************************************
}
/*************************************************************************************************************/
/*************************************************************************************************************/
if(isset($_SESSION["USER"])){
                $idprof=$_SESSION["IDPROFILE"];
                    //check if  the user exits  in databases
                   $stmt =$con->prepare("SELECT * FROM users WHERE userID=?");
                   $stmt->execute(array($idprof));
                  $count=$stmt->rowCount();
if($count>0){ 
    $userProfiles=$stmt->fetch();//get information in array
/*************************************************************************************************************/
/*************************************************************************************************************/
?>
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
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
<!------------------------------------------------>
<h1 class="text-center"><?php echo $userProfiles['Username']?></h1>
<div class="container">
    <div class="row">

        <!--end image item-->
        <!--stert contetnt item-->
         <div class="col-md-12 item-info">
                      <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="useridp" value="<?php echo $userProfiles['userID']; ?>"/>
                          
                        <!--------------------------- start  name  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Name</label>
                           <div class="col-sm-10">
                             <input
                                    pattern=".{4,}"
                                    title="This Field Required At Least 4 Character"
                                    type="text"
                                    name="name"
                                    class="form-control live"
                                    placeholder="Name of Item"
                                    value="<?php echo $userProfiles['Username']; ?>"
                                    <?php $_SESSION['USER']=$userProfiles['Username']?>
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                          <!--------------------------------------------------------------------->
                                                 <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Password</label>
                           <div class="col-sm-10">
                               <input type="hidden" name="oldpassword" value="<?php echo $userProfiles['password'] ?>"/>
                             <input type="password" name="newpassword" class="form-control" placeholder="you can kept empty" autocomplete="new-password"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  name field------------------------->
                                                 <!--------------------------- start email  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Email</label>
                           <div class="col-sm-10">
                             <input
                                    pattern=".{10,}"
                                    title="This Field Required At Least 10 Character"
                                    type="email"
                                    name="email"
                                    class="form-control live"
                                    placeholder="email of Item"
                                    value="<?php echo $userProfiles['Email']; ?>"
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  email field------------------------->
                        <!--------------------------- start  fullname  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">FullName</label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="fullname"
                                    class="form-control live"
                                    placeholder="fullname"
                                    value="<?php echo $userProfiles['Fullname']; ?>"            
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                    <!--------------------------- start  Submit field--------------------->
                       <div class="form-group form-group-lg">
                           <div class="col-sm-offset-2 col-sm-10">
                             <input
                                    type="submit"
                                    value="Update  profile"
                                    class="btn btn-primary btn-lg"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Submit  field------------------------->
                     </form><!--end form-->
           </div>
        <!--end content item-->
     </div><!--end row-->
 </div><!--end container-->
<!---------------------------------------------------------------------------------------------------------------------------------------->
<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }else{
                     echo "<div class='container'>";
                    $themessge= "<div class='alert alert-danger'>theres  no such ID or this item  is waiting approve</div>";
                    redirectHome($themessge,"back");
                    echo "</div>";
}
    }else{
    header('Location:login.php');
    exit;
}
include  $tp1."footer.php";
ob_end_flush();
?>