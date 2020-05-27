<?php
session_start();
$pagetitle="Create New Post";

if(isset($_SESSION["USER"])){
    
if(isset($_SESSION["UID"])){
 $idheader=$_SESSION["UID"];
    global $idheader;
}
    include "ini.php";
/*****************************************************************************************************************/
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title  =strtolower(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
        $desc  =filter_var($_POST['description'],FILTER_SANITIZE_STRING);
        $country =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        
        //ERRORS
        if(strlen($title)>7){
            $formErrors[]="item title must be  at less 7 character";
        }
        if(strlen($desc)<10){
            $formErrors[]="item description must be  at least 10 character";
        }
        if(strlen($country)<2){
            $formErrors[]="item country must be  at least 2 character";
        }

                    //check if error in form 
                if(empty($formErrors)){//only it'snot exist error
                $check =checkItem("Name","items",$title);
                if($check==1){
                   $themessge= "<div class='alert alert-danger'>sorry the item it's exits</div>";
                    redirectHome($themessge,'back');
                }else{
                //Insert  the database with  this info is not exis Name
                //*********************************************************************************
                //**********************************************************************************
                    
                    $stmt=$con->prepare("INSERT INTO 
                                items(Name,Description,Country_Made,Member_ID,Add_Date)
                                VALUES(:zname,:zdesc,:zcountry,:zmember,now())");
                    $stmt->execute(array(
                        'zname'     =>$title,
                        'zdesc'     =>$desc,
                        'zcountry'  =>$country,
                        'zmember'   =>$_SESSION['UID']
                    ));
                    //echo  success Message
                     if($stmt){
                          $successMessage= "<div class='alert alert-success'>".$stmt->rowCount().'Recorded Inserted</div>'; 
                         echo "<script>
                          setTimeout(function(){
                         window.location.href='index.php';
                         }, 2000);
                         </script>";
                     }
                       
                    }//end if check the username
                      
                    }//end if error 
        

    }//end request server
?>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------------->
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
<h1 class="text-center"><?php echo $pagetitle;?></h1>
<div class="creat-ad">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo $pagetitle;?></div>
            <div class="panel-body">
               <div class="row">
                   <div class="col-md-8">
                      <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <!--------------------------- start  name  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Title</label>
                           <div class="col-sm-10">
                             <input
                                    pattern=".{4,}"
                                    title="This Field Required At Least 4 Character"
                                    type="text"
                                    name="name"
                                    class="form-control live"
                                    placeholder="title of post"
                                    data-class=".live-name"
                                    minlength="4" maxlength="13" size="13"
                                    required
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

                        <!--------------------------- start  country made  field--------------------->
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Country </label>
                           <div class="col-sm-10">
                             <input
                                    type="text"
                                    name="country"
                                    class="form-control"
                                    placeholder="Country of made"
                                    required
                                    />
                              </div><!--end input-->
                           </div><!--end form group-->
                         <!-- ----------end  country made field------------------------->

                    <!--------------------------- start  image  field--------------------->
                         <!-- ----------end  image field------------------------->
                          <!----------------------Start Stock----------------------------------------->
                          <!----------------------------------------------------end stock---------------------------------->
                                                  <!----------------------Start Stock----------------------------------------->
                                                 <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Author</label>
                           <div class="col-sm-10">
                               <?php
                                 $userID=$_SESSION['UID'];
                                    $stmtf =$con->prepare("SELECT * FROM users WHERE userID=?");
                                   $stmtf->execute(array($userID));
                                  $count=$stmtf->rowCount();
                                   if($count>0){ 
                                       $userProfiles=$stmtf->fetch();
                                       }
                                 global $userProfiles;
                               ?>
                             <p style="font-size:30px;"><?php echo  $userProfiles['Username'] ?> </p>
                             <input type="hidden" name="storeID" value="<?php echo  $userProfiles['storeID']  ?>"  class="form-control"/>

                              </div><!--end input-->
                           </div><!--end form group-->
                          <!----------------------------------------------------end stock---------------------------------->

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
                   </div>
                 </div><!--end row-->
<!-------------------------------------------------------------------------------------------------------------------------------------->
                                   <!---start looping through errors-->
                   <?php
                          if(!empty($formErrors)){
                              foreach($formErrors as $error){
                                  echo "<div class='alert alert-danger'>".$error."</div>";
                              }//end foreach
                          }//end if
                            if(isset($successMessage)){
                               echo "<div class=''>".$successMessage."<?div>";
                             }
    
                   ?>
                   <!--end looping-->
            </div>
         </div><!--end panel primary-->
     </div><!--end container-->
</div><!--end information-->
<!---------------------------------------------------------------------------------------------------->

<!------------------------------------------------> 
<?php
}else{
    header('Location:login.php');
    exit;
}
include  $tp1."footer.php";
?>