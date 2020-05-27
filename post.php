<?php
ob_start();
session_start();
$pagetitle="Show posts";
include "ini.php";
if(isset($_SESSION["UID"])){
    $idme=$_SESSION["UID"];
    global $idme;
}  
//check
              if(isset($_GET['itemid'])&&is_numeric($_GET['itemid'])){
                     $itemId=intval($_GET['itemid']);
                    //check if  the user exits  in databases
                   $stmt =$con->prepare("SELECT *
                                         FROM 
                                               items
                                         WHERE
                                               Item_ID=?
                                         AND
                                               Approve=1");
                   $stmt->execute(array($itemId));
                   
                  $count=$stmt->rowCount();
              }else{
                  $count=0;
              }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($count >0){
    $item=$stmt->fetch();//get information in array
  
?>
<!----------------------------------------------->
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
<div class="item-summary">
    <h1 class="text-center"><?php echo $item['Name']?></h1>
<div class="container">
    <div class="row">
        <!--start image item-->
        <!--end image item-->
        <!--stert contetnt item-->
         <div class="col-md-12 item-info">
             <p>  <i class="fa fa-file-text fa-fw"></i>
                          <span>Description</span> :      
                 <?php echo $item['Description']?></p>
             <ul class="list-unstyled">
                      <li>
                          <i class="fa fa-calendar fa-fw"></i>
                          <span>Added Date</span> :<?php echo $item['Add_Date']?>
                       </li>

                     <li>
                         <i class="fa fa-building fa-fw"></i>
                          <span>Country</span> : <?php echo $item['Country_Made']?>
                     </li>

               </ul>

             
            </div>
        </div>

 </div><!--end container-->
    </div><!--end items summary-->
<!---------------------------------------------------------------------------------------------------------------------------------------->
<?php
        }else{
                     echo "<div class='container'>";
                    $themessge= "<div class='alert alert-danger'>theres  no such ID or this item  is waiting approve</div>";
                    redirectHome($themessge);
                    echo "</div>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
include  $tp1."footer.php";
ob_end_flush();
?>