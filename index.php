<?php
ob_start();
session_start();
$pagetitle="Home";
include "ini.php";
/******************************************************************************************************/
/******************************************************************************************************/
if(isset($_SESSION["UID"])){
    $idmemberrating=$_SESSION["UID"];
}
/******************************************************************************************************/
/******************************************************************************************************/
?>
<!----------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------time session-------------------------------------------------------------------------------->
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
<!--***************************************************************************************************************************-->
<div class="clearfix"></div>
<!----------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------all items-------------------------------------------------------------------------------->
<div class="allItems">
<div class="container">
<div class="title">
    <h2><?php echo lang('New_post');?></h2>
</div>

    
    <div class="row">
        <!--start search section --> 
        <?php
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if(isset($_POST["search"])){
            $searchWord=strtolower($_POST["search"]);
           $allitems=getPostsFav("*","items","WHERE Approve=1","And Name='{$searchWord}'","Item_ID"); 
            $_SESSION['NAMEITEM']="";
            foreach($allitems as $item){
                $_SESSION['NAMEITEM']=$item["Name"];
            }
                  if($_SESSION['NAMEITEM']!=$searchWord){
                        echo "<div class='container'>";
                        $themessge= "<div class='alert alert-danger'>"."the item not founds".'</div>';
                        redirectHome($themessge,"back");
                        echo "</div>";
                    }
        }else{//isset search
           $allitems=getPosts("items","users.Username","items","users","userID","Member_ID","WHERE Approve=1","","Item_ID"); 
        }
           //end search
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ?>
        <div class='col-sm-12 col-md-8'>
        <?php
        foreach($allitems as $item){//all items
            ?>
        
        <div class='thumbnail item-box'>
        <div class='caption'>
        <h4>Post</h4>
            <?php
        echo "<h3><span>Title Post:</span> <a href='post.php?itemid=".$item['Item_ID']."'>".$item["Name"]."</a></h3>";
        echo "<p><span>Description:</span> ".substr($item['Description'],0,10)."</p>";
        echo "<div class='date'><span>Date Post: </span>".$item['Add_Date']."</div>";
                echo "<div class='date'><span>Author: </span>".$item['Username']."</div>";
            ?>
        </div><!-------end caption------>
        </div><!-------end thumbnail----->
      
       <?php
        }//end foreach
            ?> 
             </div><!--------//end col=----->
    <!-------------------------------------------->
        <div class="col-sm-12 col-md-4">
         
        <div class="AdsPost">
            <h2>ADS</h2>
          <div class="row">
              
            <div class="col-sm-12">
              <div class="adsImage">
            <img class="img-responsive" src="layout/images/city-731296_1920-1920x1000.jpg" width="100" height="100"> 
                 </div><!--end col-sm-->
              </div><!--ebd co-->
              
              
                          <div class="col-sm-12">
              <div class="adsImage">
            <img class="img-responsive" src="layout/images/mercedes-benz-4603333_1920-1920x1000.jpg" width="100" height="100"> 
                 </div><!--end col-sm-->
              </div><!--ebd co-->
              
                          <div class="col-sm-12">
              <div class="adsImage">
            <img class="img-responsive" src="layout/images/city-731296_1920-1920x1000.jpg" width="100" height="100"> 
                 </div><!--end col-sm-->
              </div><!--ebd co-->
              
                          <div class="col-sm-12">
              <div class="adsImage">
            <img class="img-responsive" src="layout/images/mercedes-benz-4603333_1920-1920x1000.jpg" width="100" height="100"> 
                 </div><!--end col-sm-->
              </div><!--ebd co-->
              
                          <div class="col-sm-12">
              <div class="adsImage">
            <img class="img-responsive" src="layout/images/city-731296_1920-1920x1000.jpg" width="100" height="100"> 
                 </div><!--end col-sm-->
              </div><!--ebd co-->
              
              
             </div><!--end row-->
            </div><!--end adspost-->
            
            
            
            
         </div><!---end col-->
        
    <!-------------------------------------------->
    </div><!--end row-->

  </div><!--end container-->
    </div><!--end all item-->

<!-----------------------------------all posts-------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------->
<div class="newsletter">
<div class="container">
     <div class="row">
         <div class="col-md-6">
             <div class="newscontent">
                 <h2>Subscribe to our Newsletter</h2>
                 <p>Sign up for our weekly trips, skills, gear and survival newsletters.</p>
                 <span>Magazine publishes monthly, except for combined issues that count as<br> two, as indicated on issue’s cover.</span>
                </div><!--end newscontent-->
           </div><!--end col-md 6-->
         
         <div class="col-md-6">
             <img class="img-responsive" src="layout/images/Photorealistic-Magazine-GutenVerse-768x551.png">
            </div>
       </div><!--end row-->
    </div><!--end container-->
 </div><!--end newsletter-->
<!------------------------------------------------------------------------------------------------------------------------------------
<div>
<div class="container">
<?php
/*
    echo '<pre>';
var_dump($_SESSION); 
echo '</pre>';
*/
    ?>
    
</div>
</div>
-->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php
include  $tp1."footer.php";
ob_end_flush();
?>