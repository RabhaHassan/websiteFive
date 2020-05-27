<?php
/*
==Manage Members Page
== you can Add| Edit| DELETE members  from here
*/
session_start();
$pagetitle="Members";//title page by function 
if(isset($_SESSION["USERNAME"])){
  include "ini.php";
    //do
    $do=" ";
if(isset($_GET['do'])){
    $do =$_GET['do'];
}else{
    $do='Manage';
}
    //*if the page is main page*
//******************************************************MANAGE MEMBERS****************************************
            if($do=='Manage'){//manage page
            //pending memebers
                $query="";
                if(isset($_GET['page']) && $_GET['page']=='pending'){
                 $query="AND Ragestatus=0";   
                }
             //select  all users  exept  admin
                $stmt=$con->prepare("SELECT * FROM users WHERE GroupID !=1 $query
                ORDER BY userID DESC
                ");
             //execute  the statement
                $stmt->execute();
             //Assign  to Variable
                $members=$stmt->fetchAll();
                
         ?>
            <?php if($members){ ?>
                <h1 class="text-center">Manage Members</h1>
               <div class="container">
                   <div class="table-responsive">
                       <table class="main-table manage-members text-center table table-bordered">
                           <tr>
                               <td>#ID</td>
                               <td>Avatar</td>
                               <td>Username</td>
                               <td>Email</td>
                               <td>Fullname</td>
                               <td>Registerd Date</td>
                               <td>Control</td>
                             </tr>
                           <?php
                                foreach($members as $member){
                                   echo "<tr>";
                                    echo "<td>" .$member['userID']."</td>";
                                    echo "<td>";
                                     if(empty($member['avatar'])){
                                         echo "No image";
                                     }else{
                                         echo "<img src='uploads/avatar/".$member['avatar']."'alt=''/>";
                                         $_SESSION['AVATARM']=$member['avatar'];
                                     }
                                    echo"</td>";
                                      echo "<td>" .$member['Username']."</td>";
                                    echo "<td>" .$member['Email']."</td>";
                                    echo "<td>" .$member['Fullname']."</td>"; 
                                    echo "<td>" .$member['Date']."</td>"; 
                                    echo "<td>
            <a href='members.php?do=Edit&userid=".$member['userID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
            <a href='members.php?do=Delete&userid=".$member['userID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                            if($member['Ragestatus']==0){
                             echo "<a href='members.php?do=Activate&userid=".$member['userID']."' class='btn btn-info activate'><i class='fa fa-check'></i>Activate</a>";   
                            }//end if button active
                                    echo "</td>";
                                   echo "</tr>";
                                };
             
                           ?>
                          </table><!--end table-->
                     </div><!--end table-responsive-->
        <a href="members.php?do=Add" class="btn btn-primary"><i class=" fa fa-plus"></i>New Member</a>
                 </div><!--end container-->
                           <?php }else{
                       echo "<div class='container'>";//start container
                         echo "<div class='nice-message'>";
                         echo "There's No Record To Show";
                         echo "</div>";//end nice message
             echo ' <a href="members.php?do=Add" class="btn btn-primary"><i class=" fa fa-plus"></i>New Member</a>';
                         echo "</div>";//end container
                                         } ?>
<!--******************************************************ADD MEMBERS****************************************-->
           <?php }elseif($do=='Add'){//Add page and linked with page insert?>
                <h1 class="text-center">Add New Member</h1>
               <div class="container">
                     <form class="form-horizontal" action="?do=Insert" method="post" enctype="multipart/form-data">
                        <!--------------------------- start  username  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Username</label>
                           <div class="col-sm-10">
                             <input type="text" name="username" class="form-control"  autocomplete="off" required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  username  field------------------------->
                                     <!--------------------------- start  password  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Password</label>
                           <div class="col-sm-10">
                             <input type="password" name="password" class="password form-control" placeholder="you can kept empty" autocomplete="new-password" required="required"/>
                               <i class="show-pass fa fa-eye fa-2x"></i>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  password  field------------------------->
                                     <!--------------------------- start  email  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Email</label>
                           <div class="col-sm-10">
                             <input type="email" name="email"   class="form-control" required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  email  field------------------------->
                                     <!--------------------------- start  fullname  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Fullname</label>
                           <div class="col-sm-10">
                             <input type="text" name="Full"  class="form-control"required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  fullname  field------------------------->
                                                        <!--------------------------- start  image  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">User Avatar</label>
                           <div class="col-sm-10">
                             <input type="file" name="avatar"  class="form-control"required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  image field------------------------->
                                     <!--------------------------- start  Submit field--------------------->
                       <div class="form-group form-group-lg">
                           <div class="col-sm-offset-2 col-sm-10">
                             <input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Submit  field------------------------->
                     </form><!--end form-->
                </div><!--end container-->
<!--*****************************************************Insert data memmbers*******************************************-->
           <?php
                 }elseif($do=="Insert"){
            if($_SERVER['REQUEST_METHOD']=='POST'){
               echo "<h1 class='text-center'>Update Member</h1>";
               echo "<div class='container'>";
                
                //upload avatar 
                $avatarname=$_FILES['avatar']['name'];
                $avatarsize=$_FILES['avatar']['size'];
                $avatartmp=$_FILES['avatar']['tmp_name'];
                $avatartype=$_FILES['avatar']['type'];
                //list of allowed  file  typed to upload
                $avatarAllowedExtention=array("jpeg","jpg","png","gif");
                //get avatar extention
                $avatarexplode=explode('.',$avatarname);
                $avatarExtention=end($avatarexplode);
                $avatarExtentionx=strtolower($avatarExtention);
                //Get variable from form 
                $user =$_POST['username'];//from page add
                $pass =$_POST['password'];//from page add
                $email=$_POST['email'];//from page add
                $name=$_POST['Full'];//from page add
                $hashpass=sha1($_POST['password']);
                //validate the form 
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
                if(empty($name)){
                 $formerror[]="<div class='alert alert-danger'>Fullname can't be empty</div>";   
                }
                if(! empty($avatarname) && ! in_array($avatarExtentionx,$avatarAllowedExtention)){
                 $formerror[]="<div class='alert alert-danger'>This Extention isno't be empty</div>";   
                }
                if(empty($avatarname)){
                 $formerror[]="<div class='alert alert-danger'>Avatar is required</div>";   
                }
                if($avatarsize>4194304){
                 $formerror[]="<div class='alert alert-danger'>Avatar cant be  larger 4 mega</div>";   
                }
                foreach($formerror as $errorForm){
                    echo $errorForm .'</br>';
                }
                //check if error in form 
                if(empty($formerror)){//only it'snot exist error
                    //avatar
           $avatar=rand(0,100000).'_'.$avatarname;//name random for image 
         //check if the username it's exits
                $check =checkItem("Username","users",$user);
                if($check==1){
                   $themessge= "<div class='alert alert-danger'>sorry the username it's exits</div>";
                    redirectHome($themessge,'back');
                }else{
                //Insert  the database with  this info is not exist unsername 
                //*********************************************************************************
                    $stmt=$con->prepare("INSERT INTO 
                                                users(Username,password,Email,Fullname,Ragestatus,Date,avatar)
                                                VALUES(:zusername,:zpassword,:zemail,:zfullname,1,now(),:zavatar)");
                    $stmt->execute(array(
                        'zusername' =>$user,
                        'zpassword' =>$hashpass,
                        'zemail'    =>$email,
                        'zfullname' =>$name,
                        'zavatar'   =>$avatar
                    ));
                    if($stmt){
                        move_uploaded_file($avatartmp,"uploads\avatar\\".$avatar);
                    }
                    
                    //echo  success Message
                    $themessge= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Inserted</div>'; 
                        redirectHome($themessge,'back');
                    }//end if check the username

                    }//end if error 


                    }else{//end if server     
                         echo "<div class='container'>";
                        $themessge="<div class='alert alert-danger'>sorry  you cant browse this page directly</div>";
                        redirectHome($themessge);
                    echo "</div>";
                    } //end if server 
 //*****************************************************EDIT PROFILE*******************************************-->
                 }elseif($do=="Edit"){//edit page and close tag php 
                global $count;
                 if(isset($_GET['userid'])&&is_numeric($_GET['userid'])){
                     $userId=intval($_GET['userid']);
                    //check if  the user exits  in databases
                   $stmt =$con->prepare("SELECT * FROM users WHERE userID=? ");
                   $stmt->execute(array($userId));
                   $row=$stmt->fetch();//get information in array
                   $count=$stmt->rowCount();
                    $_SESSION['AVATARM']=$row['avatar'];
                 }//end if check
                if($count >0){
                ?>     
                <h1 class="text-center">Edit Member</h1>
               <div class="container">
                     <form class="form-horizontal" action="?do=Update" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="userid" value="<?php echo $userId ?>"/>
                        <!--------------------------- start  username  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Username</label>
                           <div class="col-sm-10">
                             <input type="text" name="username" class="form-control" value="<?php 
                    echo $row['Username'];
                    ?>" autocomplete="off" required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  username  field------------------------->
                                     <!--------------------------- start  password  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Password</label>
                           <div class="col-sm-10">
                               <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>"/>
                             <input type="password" name="newpassword" class="form-control" placeholder="you can kept empty" autocomplete="new-password"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  password  field------------------------->
                                     <!--------------------------- start  email  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Email</label>
                           <div class="col-sm-10">
                             <input type="email" name="email"  value="<?php echo $row['Email']?>" class="form-control" required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  email  field------------------------->
                                     <!--------------------------- start  fullname  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Fullname</label>
                           <div class="col-sm-10">
                             <input type="text" name="Full" value="<?php echo $row['Fullname']?>" class="form-control"required="required"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  fullname  field------------------------->
                                    <!--------------------------- start  image  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">User Avatar</label>
                           <div class="col-sm-10">
                             <input type="file" name="avatar"  class="form-control" />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  image field------------------------->
                                     <!--------------------------- start  Submit field--------------------->
                       <div class="form-group form-group-lg">
                           <div class="col-sm-offset-2 col-sm-10">
                             <input type="submit" value="Save" class="btn btn-primary btn-lg"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Submit  field------------------------->
                     </form><!--end form-->
                </div><!--end container-->
            <?php }else{
                    echo "<div class='container'>";
                    $themessge= "<div class='alert alert-danger'>theres  no such ID</div>";
                    redirectHome($themessge);
                    echo "</div>";
                }//END IF COUNT ROW
//**********************************************************UPDATE PROFIEL*********************************************
             }elseif($do=="Update"){//start update
               echo "<h1 class='text-center'>Update Member</h1>";
               echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //upload avatar 
                $avatarname=$_FILES['avatar']['name'];
                $avatarsize=$_FILES['avatar']['size'];
                $avatartmp=$_FILES['avatar']['tmp_name'];
                $avatartype=$_FILES['avatar']['type'];
                //list of allowed  file  typed to upload
                $avatarAllowedExtention=array("jpeg","jpg","png","gif");
                //get avatar extention
                $avatarexplode=explode('.',$avatarname);
                $avatarExtention=end($avatarexplode);
                $avatarExtentionx=strtolower($avatarExtention);
                //Get variable from form 
                $id=$_POST['userid'];
                $user =$_POST['username'];
                $email=$_POST['email'];
                $name=$_POST['Full'];
                //password trick 
                $pass="";
                if(empty($_POST['newpassword'])){
                  $pass= $_POST['oldpassword']; 
                }else{
                    $pass=sha1($_POST['newpassword']);
                }
                
                
                //validate the form 
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
                if(empty($name)){
                 $formerror[]="<div class='alert alert-danger'>Fullname can't be empty</div>";   
                }
                if(! empty($avatarname) && ! in_array($avatarExtentionx,$avatarAllowedExtention)){
                 $formerror[]="<div class='alert alert-danger'>This Extention isno't be empty</div>";   
                }
                if($avatarsize>4194304){
                 $formerror[]="<div class='alert alert-danger'>Avatar cant be  larger 4 mega</div>";   
                }
                foreach($formerror as $errorForm){
                    echo $errorForm .'</br>';
                }
                //check if error in form 
                if(empty($formerror)){
                    
                    
                    
       if(is_uploaded_file($avatartmp)){
           $avatar=rand(0,100000).'_'.$avatarname;//name random for image
         }else{
             
            $avatar=$_SESSION['AVATARM'];
         }
                    
                    
                $stmt2=$con->prepare("SELECT* FROM users WHERE Username=? AND userID !=?");
                $stmt2->execute(array($user,$id));
                $count=$stmt2->rowCount();
                if($count>0){
                $themessge= "<div class='alert alert-success'>".$stmt2->rowCount().'Recorded Update</div>';  
                    echo "<div class='alert alert-danger'>Sorry this user is exits</div>";
                redirectHome($themessge,"back");
                }else{
                    //update image 
                                $stmtI=$con->prepare("UPDATE 
                                      users 
                                   SET 
                                      avatar=?
                                      WHERE userID=?");

              $stmtI->execute(array($avatar,$id));
            if($stmtI){
              move_uploaded_file($avatartmp,"uploads\avatar\\".$avatar);
            }
                    
                                  //update  the database with  this info 
                $stmt=$con->prepare("UPDATE users SET Username=?,Email=?,Fullname=?,password=? WHERE userID=?");
                $stmt->execute(array($user,$email,$name,$pass,$id));
                    if($stmt){
                             //echo  success Message
                $themessge= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Update</div>';  
                redirectHome($themessge,"back");
                    }
                    
                    
           
                }//end if count  
                    
                    
                }//if form error


            }else{//end request
                
                $themessge= "<div class='alert alert-danger'>sorry  you cant browse this page directly</div>";
                redirectHome($themessge);
            }
            echo "</div>";//end container
        }//end if update
//**************************************************Start Delete PROFILE*******************************************************
    elseif($do=="Delete"){//delete page
                       echo "<h1 class='text-center'>Delete Member</h1>";
               echo "<div class='container'>";
                    if(isset($_GET['userid'])&&is_numeric($_GET['userid'])){
                     $userId=intval($_GET['userid']);
                      $check =checkItem("userID","users",$userId);  
                 }//end if check
        
        
        
        
                if($check >0){
                    $stmt=$con->prepare("DELETE FROM users WHERE userID=?");
                    $stmt->execute(array($userId));
                    $themessge="<div class='alert alert-success'>".$stmt->rowCount().'Recorded deleted</div>';
                     if(isset($_SESSION["UID"])){
                if($_SESSION["UID"]==$userId){
                unset($_SESSION["USER"]);
                unset($_SESSION["UID"]);
                unset($_SESSION["UIDITEM"]);
                unset($_SESSION["NAMEITEM"]);
                unset($_SESSION["resetEmail"]);
                unset($_SESSION["AVATARM"]);
                    }
                     }

                    redirectHome($themessge);

                }else{
                    
                    $themessge= "<div class='alert alert-danger'>This ID is not exist</div>";
                    redirectHome($themessge);
                }
        
        
        
        
        
        echo "</div>";
//****************************************************************************************************************************
    }elseif($do=="Activate"){//activate
                               echo "<h1 class='text-center'>Activate Members</h1>";
               echo "<div class='container'>";
                    if(isset($_GET['userid'])&&is_numeric($_GET['userid'])){
                     $userId=intval($_GET['userid']);
                      $check =checkItem("userID","users",$userId);  
                 }//end if check
                if($check >0){
                    $stmt=$con->prepare("UPDATE users SET Ragestatus=1 WHERE userID=?");
                    $stmt->execute(array($userId));
                    $themessge="<div class='alert alert-success'>".$stmt->rowCount().'Activate Member </div>';
                    redirectHome($themessge);
                }else{
                    
                    $themessge= "<div class='alert alert-danger'>This ID is not exist</div>";
                    redirectHome($themessge);
                }
        echo "</div>";
    }
//**************************************************END Delete PROFILE******************************************************
  include  $tp1 . "footer.php";
}else{
    header('location:index.php');
    exit();
}
?>