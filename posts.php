<?php
ob_start();
session_start();
$pagetitle="Products";
include "ini.php";
/**********************************************************************************************/
if(isset($_SESSION["UID"])){
    $idmemberPost=$_SESSION["UID"];
}
/**********************************************************************************************/
?>
<!-----------------------------start slider--------------->
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
<!-----------------------------------all posts-------------------------------------------------------------------------------->
<div class="clearfix"></div>
<div class="allItems">
<div class="container">
<div class="title">
    <h2><?php echo lang('products');?></h2>
</div>
    <div class="row">
        <!--start search section --> 
        
        <?php
    
    
        if(isset($_POST["search"])){
           $allitems=getAllFrom("*","items","WHERE Approve=1","And Name='{$_POST["search"]}'","Item_ID"); 
            $_SESSION['NAMEITEM']="";
            foreach($allitems as $item){
                $_SESSION['NAMEITEM']=$item["Name"];
            }
            
            
            
                  if($_SESSION['NAMEITEM']!=$_POST["search"]){
                        echo "<div class='container'>";
                        $themessge= "<div class='alert alert-danger'>"."the item not founds".'</div>';
                        redirectHome($themessge,"back");
                        echo "</div>";
                    }
             
            
        }else{//isset search
                global $con;
            
/////////////================================================================================================
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set records or rows of data per page
$recordsPerPage = 4;
 
// calculate for the query LIMIT clause
$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;
            
// ********** show the number paging
 
// find out total pages
$query = "SELECT COUNT(*) as total_rows FROM items";
$stmt = $con->prepare( $query );
$stmt->execute();
 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];
 
$total_pages = ceil($total_rows / $recordsPerPage);
// range of num links to show
$range = 2;
 
// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
/////////////////////////////========================================================================================
            
$allitems=getPosts("items","users.Username","items","users","userID","Member_ID","WHERE Approve=1","","Item_ID"); 

        }
    
    
    
    
           //end search
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        foreach($allitems as $item){
            ?>
        
        <div class='col-sm-12 col-md-12'>
        <div class='thumbnail item-box'>
        <div class='caption'>
        <h4>Post</h4>
            <?php
        echo "<h3><span>Title Post:</span> <a href='post.php?itemid=".$item['Item_ID']."'>".$item["Name"]."</a></h3>";
        echo "<p><span>Description:</span> ".substr($item['Description'],0,10)."</p>";
        echo "<div class='date'><span>Date Post: </span>".$item['Add_Date']."</div>";
             if(!(isset($_POST["search"]))){
        echo "<div class='date'><span>Author: </span>".$item['Username']."</div>";
             }
            ?>
        </div><!-------end caption------>
        </div><!-------end thumbnail----->
       </div><!--------//end col=----->
       <?php
        }//end foreach
            ?> 
    </div><!--end row-->
  </div><!--end container-->
    </div><!--end all item-->

<!--------------------------------------------end all items---------------------------------------------------------------------------->
<?php  if(!(isset($_POST["search"]))){?>
<nav aria-label="Page navigation">
<div class="container">
 <ul class="pagination">
<li>
<?php
if($page>1){
    // ********** show the first page
    echo "<a href='" . $_SERVER['PHP_SELF'] . "' title='Go to the first page.' class='customBtn'>";
        echo "<span style='margin:0 .5em;'> << </span>";
    echo "</a>";
     
    // ********** show the previous page
    $prev_page = $page - 1;
    echo "<a href='" . $_SERVER['PHP_SELF'] 
            . "?page={$prev_page}' title='Previous page is {$prev_page}.' class='customBtn'>";
        echo "<span style='margin:0 .5em;'> < </span>";
    echo "</a>";
     
}
?>
     </li>
<li>
<?php
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
     
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
     
        // current page
        if ($x == $page) {
            echo "<span class='customBtn' style='background:#e85442;color:white;'>$x</span>";
        } 
         
        // not current page
        else {
            echo " <a href='{$_SERVER['PHP_SELF']}?page=$x' class='customBtn'>$x</a> ";
        }
    }
}
?>
 </li>   
    
<li>
<?php
// ***** for 'next' and 'last' pages
if($page<$total_pages){
    // ********** show the next page
    $next_page = $page + 1;
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$next_page}' title='Next page is {$next_page}.' class='customBtn'>";
        echo "<span style='margin:0 .5em;'> > </span>";
    echo "</a>";
     
    // ********** show the last page
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$total_pages}' title='Last page is {$total_pages}.' class='customBtn'>";
        echo "<span style='margin:0 .5em;'> >> </span>";
    echo "</a>";
}

?>
    </li>
    </ul>
</div>
</nav>
<?php
    }
include  $tp1."footer.php";
ob_end_flush();
?>