<?php
/*
==Items Page
== you can Add| Edit| DELETE members  from here
*/
ob_start();//output buffering  start 
session_start();
$pagetitle="Items";//title page by function 
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
//******************************************************MANAGE Items****************************************
           if($do=='Manage'){//manage page
                $stmt=$con->prepare("SELECT * FROM items
                    ORDER BY Item_ID DESC
                    ");
             //execute  the statement
                $stmt->execute();
             //Assign  to Variable
                $items=$stmt->fetchAll(); 
         ?>
             <?php if(!empty($items)){ ?>
                <h1 class="text-center">Manage Items</h1>
               <div class="container">
                   <div class="table-responsive">
                       <table class="main-table text-center table table-bordered">
                           <tr>
                               <td>#ID</td>
                               <td>Name</td>
                               <td>Description</td>
                               <td>Adding Date</td>
                               <td>Control</td>
                             </tr>
                           <?php
                                foreach($items as $item){
                                   echo "<tr>";
                                    echo "<td>" .$item['Item_ID']."</td>";
                                      echo "<td>" .$item['Name']."</td>";
                                    echo "<td>" .$item['Description']."</td>";
                                    echo "<td>" .$item['Add_Date']."</td>"; 
                                    echo "<td>
            <a href='posts.php?do=Edit&itemid=".$item['Item_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
            <a href='posts.php?do=Delete&itemid=".$item['Item_ID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                            if($item['Approve']==0){
                             echo "<a href='posts.php?do=Approve&itemid=".$item['Item_ID']."' class='btn btn-info activate'><i class='fa fa-check'></i>Approve</a>";   
                            }//end if button active
                                    echo "</td>";
                                   echo "</tr>";
                                };
                           ?>
                          </table><!--end table-->
                     </div><!--end table-responsive-->
        <a href="posts.php?do=Add" class="btn btn-primary"><i class=" fa fa-plus"></i>New Post</a>
                 </div><!--end container-->
           <?php }else{
             echo "<div class='container'>";//start container
             echo "<div class='nice-message'>";
             echo "There's No Record To Show";
             echo "</div>";//end nice message
             echo '<a href="posts.php?do=Add" class="btn btn-primary"><i class=" fa fa-plus"></i>New Item</a>';
             echo "</div>";//end container
         }?>
<!------------------------------------------------------------------------------------------------------------------------------------->
          <?php }elseif($do=='Add'){?>

                <h1 class="text-center">Add New Post</h1>
               <div class="container">
                     <form class="form-horizontal" action="?do=Insert" method="post">
                        <!--------------------------- start  name  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Name</label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Name of Item"
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  name field------------------------->
                                                 <!--------------------------- start  Description  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Description</label>
                           <div class="col-sm-10">
                       <textarea name="description" class="form-control" placeholder="Description" required></textarea>  
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Description field------------------------->
                         <!-- ----------end  Description field------------------------->
                        <!--------------------------- start  country made  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Country</label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="country"
                                    class="form-control"
                                    placeholder="Country of made"
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  country made field------------------------->
                                             <!--------------------------- start  members  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Members</label>
                           <div class="col-sm-10">
                            <select name="members">
                                <option value="0">....</option>
                                <?php
                                    $allMembers=getAllFrom("*","users","where truststatus=0","","userID");
                                                foreach($allMembers as $user){
                                                  echo "<option value='".$user['userID']."'>".$user['Username']."</option>"; 
                                                }
                                 ?>
                                </select>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  members field------------------------->
                         <!-- ----------end  members field------------------------->
                         <!-- ----------end  tags field------------------------->
                                     <!--------------------------- start  Submit field--------------------->
                       <div class="form-group form-group-lg">
                           <div class="col-sm-offset-2 col-sm-10">
                             <input
                                    type="submit"
                                    value="Add  Post"
                                    class="btn btn-primary btn-lg"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Submit  field------------------------->
                     </form><!--end form-->
                </div><!--end container-->
<!------------------------------------------------------------------------------------------------------------------------------------->
           <?php  
           }elseif($do=="Insert"){
             if($_SERVER['REQUEST_METHOD']=='POST'){
               echo "<h1 class='text-center'>Update Items</h1>";
               echo "<div class='container'>";
                //Get variable from form 
                $nameItem =$_POST['name'];//from page add
                $descItem =$_POST['description'];//from page add
                $countryItem=$_POST['country'];//from page add
                $memberItem=$_POST['members'];//from page add
                //validate the form 
                $formerror=array();
                if(empty($nameItem)){
                  $formerror[]="<div class='alert alert-danger'>can not empty</div>";   
                }
                if(empty($descItem)){
                  $formerror[]="<div class='alert alert-danger'> can not empty</div>";   
                }
                if(empty($countryItem)){
                 $formerror[]="<div class='alert alert-danger'>can not empty</div>";   
                }
                if($memberItem ==0){
                 $formerror[]="<div class='alert alert-danger'>you must choose the member</div>";   
                }
                foreach($formerror as $errorForm){
                    echo $errorForm .'</br>';
                }
                //check if error in form 
                if(empty($formerror)){//only it'snot exist error
                //check if the item name it's exits
                $check =checkItem("Name","items",$nameItem);
                if($check==1){
                   $themessge= "<div class='alert alert-danger'>sorry the item it's exits</div>";
                    redirectHome($themessge,'back');
                }else{
                //Insert  the database with  this info is not exist item name
                //*********************************************************************************
                    $stmt=$con->prepare("INSERT INTO 
                                                items(Name,Description,Country_Made,ADD_Date,Member_ID)
                                                VALUES(:zname,:zdesc,:zcountry,now(),:zmember)");
                    $stmt->execute(array(
                        'zname'     =>$nameItem,
                        'zdesc'     =>$descItem,
                        'zcountry'  =>$countryItem,
                        'zmember'   =>$memberItem
                    ));
                    //echo  success Message
                    $themessge= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Inserted</div>'; 
                        redirectHome($themessge,'back');
                    }//end if check the name item

                    }//end if error 


                    }else{// server     
                         echo "<div class='container'>";
                        $themessge="<div class='alert alert-danger'>sorry  you cant browse this page directly</div>";
                        redirectHome($themessge);
                    echo "</div>";
                    } //end if server 
//***************************************************************************************************************************************
           }elseif($do=="Edit"){
               global $count;
                 if(isset($_GET['itemid'])&&is_numeric($_GET['itemid'])){
                     $itemId=intval($_GET['itemid']);
                    //check if  the user exits  in databases
                   $stmt =$con->prepare("SELECT * FROM items WHERE Item_ID=? ");
                   $stmt->execute(array($itemId));
                   $row=$stmt->fetch();//get information in array
                   $count=$stmt->rowCount();
                 }//end if check
                if($count >0){
                ?>     
                <h1 class="text-center">Edit post</h1>
               <div class="container">
                   <form class="form-horizontal" action="?do=Update" method="post">
                       <input type="hidden" name="itemid" value="<?php echo $itemId ?>"/>
                        <!--------------------------- start  name  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Title</label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="<?php 
                                $_SESSION["titlePost"]=$row['Name'];
                                    echo $_SESSION["titlePost"];
                                           ?>"
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  name field------------------------->
                                                 <!--------------------------- start  Description  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Description</label>
                           <div class="col-sm-10">
                               <textarea name="description" class="form-control" placeholder="Description"><?php echo $row['Description']?></textarea>  
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Description field------------------------->
                         <!-- ----------end  Description field------------------------->
                        <!--------------------------- start  country made  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Country</label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="country"
                                    class="form-control"
                                    value="<?php echo $row['Country_Made']?>"
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  country made field------------------------->
                                             <!--------------------------- start  members  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Members</label>
                           <div class="col-sm-10">
                            <select name="members">
                                <?php
                                    $stmtItem=$con->prepare("SELECT * FROM users where Truststatus=0");
                                    $stmtItem->execute();
                                   $users=$stmtItem->fetchAll();
                                                foreach($users as $user){
                                                  echo "<option value='".$user['userID']."'";
                                                    if($row['Member_ID']==$user['userID']){echo "selected";}
                                                    echo ">".$user['Username']."</option>"; 
                                                }
                                 ?>
                                </select>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  members field------------------------->
                         <!-- ----------end  members field------------------------->
                                    <!--------------------------- start  tags  field--------------------->
                         <!-- ----------end  tags field------------------------->
                                     <!--------------------------- start  Submit field--------------------->
                                     <!--------------------------- start  Submit field--------------------->
                       <div class="form-group form-group-lg">
                           <div class="col-sm-offset-2 col-sm-10">
                             <input
                                    type="submit"
                                    value="Update  Item"
                                    class="btn btn-primary btn-lg"/>
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  Submit  field------------------------->
                     </form><!--end form-->
<!------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------>
                
            <?php }else{
                    echo "<div class='container'>";
                    $themessge= "<div class='alert alert-danger'>theres  no such ID</div>";
                    redirectHome($themessge);
                    echo "</div>";
                }//END IF COUNT ROW
               
//***************************************************************************************************************************************
            }elseif($do=="Update"){
                             echo "<h1 class='text-center'>Update items</h1>";
               echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Get variable from form 
                $id=$_POST['itemid'];
                global $titlePost;
                $nameItem =$_POST['name'];//from page add
                $descItem =$_POST['description'];//from page add
                $countryItem=$_POST['country'];//from page add
                $memberItem=$_POST['members'];//from page add
              //validate the form 
                $formerror=array();
                if(empty($nameItem)){
                  $formerror[]="<div class='alert alert-danger'>can not empty</div>";   
                }
                if(empty($descItem)){
                  $formerror[]="<div class='alert alert-danger'> can not empty</div>";   
                }
                if(empty($countryItem)){
                 $formerror[]="<div class='alert alert-danger'>can not empty</div>";   
                }
                if($memberItem ==0){
                 $formerror[]="<div class='alert alert-danger'>you must choose the member</div>";   
                }
                foreach($formerror as $errorForm){
                    echo $errorForm .'</br>';
                }
                //check if error in form 
                if(empty($formerror)){
                    global $nameItem;
                    if($_SESSION["titlePost"] != $nameItem){
                    $check =checkItem("Name","items",$nameItem);
                  if($check==1){
                   $themessge= "<div class='alert alert-danger'>sorry the item it's exits</div>";
                    redirectHome($themessge,'back');
                }else{
                           //update  the database with  this info 
                $stmt=$con->prepare("UPDATE
                                       items
                                    SET 
                                       Name=?,
                                       Description=?,
                                       Country_Made=?,
                                       Member_ID=?
                                       WHERE Item_ID=?");
                $stmt->execute(array($nameItem,$descItem,$countryItem,$memberItem,$id));
                //echo  success Message
                $themessge= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Update</div>';  
                    redirectHome($themessge,"back");
                        }//end if check
                        
                  }else{//end equal 
                                                //update  the database with  this info 
                $stmt=$con->prepare("UPDATE
                                       items
                                    SET 
                                       Name=?,
                                       Description=?,
                                       Country_Made=?,
                                       Member_ID=?
                                       WHERE Item_ID=?");
                $stmt->execute(array($nameItem,$descItem,$countryItem,$memberItem,$id));
                //echo  success Message
                $themessge= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Update</div>';  
                    redirectHome($themessge,"back");   
                    }  
                    
                }//end form error

            }else{//request
                
                $themessge= "<div class='alert alert-danger'>sorry  you cant browse this page directly</div>";
                redirectHome($themessge);
            }
            echo "</div>";//end container
               
//***************************************************************************************************************************************
            }elseif($do=="Delete"){
                                      echo "<h1 class='text-center'>Delete Item</h1>";
               echo "<div class='container'>";
                    if(isset($_GET['itemid'])&&is_numeric($_GET['itemid'])){
                     $itemId=intval($_GET['itemid']);
                   //$stmt =$con->prepare("SELECT * FROM users WHERE userID=? ");
                   //$stmt->execute(array($userId));
                   //FETCH IF YOU PRINT INFORMATION FROM DATABASE
                   //$count=$stmt->rowCount();
                    //check if  the user exits  in databases
                      $check =checkItem("Item_ID","items",$itemId);  
                 }//end if check
                if($check >0){
                    $stmt=$con->prepare("DELETE FROM items WHERE Item_ID=?");
                    $stmt->execute(array($itemId));
                    $themessge="<div class='alert alert-success'>".$stmt->rowCount().'Recorded deleted</div>';
                    redirectHome($themessge,"back");
                }else{
                    
                    $themessge= "<div class='alert alert-danger'>This ID is not exist</div>";
                    redirectHome($themessge);
                }
        echo "</div>";
//***************************************************************************************************************************************     
           }elseif($do=="Approve"){
                                              echo "<h1 class='text-center'>Approve Item</h1>";
               echo "<div class='container'>";
                    if(isset($_GET['itemid'])&&is_numeric($_GET['itemid'])){
                     $itemId=intval($_GET['itemid']);
                   //$stmt =$con->prepare("SELECT * FROM users WHERE userID=? ");
                   //$stmt->execute(array($userId));
                   //FETCH IF YOU PRINT INFORMATION FROM DATABASE
                   //$count=$stmt->rowCount();
                    //check if  the user exits  in databases
                      $check =checkItem("Item_ID","items",$itemId);  
                 }//end if check
                if($check >0){
                    $stmt=$con->prepare("UPDATE items SET  Approve=1 WHERE Item_ID=?");
                    $stmt->execute(array($itemId));
                    $themessge="<div class='alert alert-success'>".$stmt->rowCount().'Approve Item </div>';
                    redirectHome($themessge);
                }else{
                    
                    $themessge= "<div class='alert alert-danger'>This ID is not exist</div>";
                    redirectHome($themessge);
                }
        echo "</div>";
                
            }
//****************************************************************************************************************************
  include  $tp1 . "footer.php";
}else{// end if seassion
    header('location:index.php');
    exit();
}
ob_end_flush();
?>