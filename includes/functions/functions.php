<?php
/****************************************************************************************************************************************/
/*
**Get All Records function v.2
**function to  get information from any database table
*/
function getAllFrom($field,$table,$where=NULL,$and=NULL,$orderfield,$ordering="DESC"){
    global $con;
    $getAll=$con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
    $getAll->execute();
    $items=$getAll->fetchAll();
    return $items;
}

/****************************************************************************************************************************************/
/*
**Get All Records function v.2
**function to  get information from any database table
*/
function getPostsFav($field,$table,$where=NULL,$and=NULL,$orderfield,$ordering="DESC",$limit=4){
    global $con;
    $getAll=$con->prepare("SELECT 
    $field
    FROM $table
    $where
    $and
    ORDER BY
    $orderfield $ordering LIMIT $limit");
    $getAll->execute();
    $items=$getAll->fetchAll();
    return $items;
}
/****************************************************************************************************************************************/
/*
**Get All Records function v.2
**function to  get information from any database table
*/
function getPosts($field,$join,$table,$tablejoin,$joinRow,$tableRow,$where=NULL,$and=NULL,$orderfield,$ordering="DESC",$limit=4){
    global $con;
                $stmt=$con->prepare("SELECT $field.*,
                $join
                FROM $table
                    INNER JOIN $tablejoin ON $tablejoin.$joinRow = $table.$tableRow
                    $where
                    $and
                    ORDER BY $orderfield $ordering  LIMIT $limit
                    ");
    $stmt->execute();
    $posts=$stmt->fetchAll();
    return $posts;
}
/****************************************************************************************************************************************/
/*
**check  items  function  v1
**function to check  item  in database[function accept parameters]
**$select=the  item  to select [example:user,item,category]
**$from=the table  to select from [example:users,items,categories]
**$value=the value  of select[example:osama,box,electronics]
*/
function checkItem($select,$from,$value){
    global $con;
    $statement=$con->prepare("SELECT $select From $from WHERE $select=?");
    $statement->execute(array($value));
    $count=$statement->rowCount();
    return $count;
}
/****************************************************************************************************************************************/
/*
**check every table  function  v2
*/
function checkAll($field,$table,$where=NULL,$and=NULL){
    global $con;
    $checkA=$con->prepare("SELECT $field FROM $table $where $and");
    $checkA->execute();
    $countA=$checkA->rowCount();
    return $countA;
}
/****************************************************************************************************************************************/
/*
**title function that echo  the page  title  in case  the page
**has the variable  pagetitle and echo  defult title for other page
*/
function gettitle(){
    global $pagetitle;
    if(isset($pagetitle)){
        echo $pagetitle;
    }else{
        echo "Defult";
    }
}
/****************************************************************************************************************************************/
/*
**Home Redirect Function[This Function Accept Parameters]
**$theMsg=Echo  the error message [Error,sucess,warning]
**$Seconds=Seconds Before   Redirecting
*/
function redirectHome($therMsg,$url=null,$Seconds=3){
    global $link;
    if($url == null){
        $url='index.php';
        $link="Homepage";
    }else{
        if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !=""){
            $url=$_SERVER['HTTP_REFERER'];
            $link="previous page";
        }else{
            $url='index.php';
            $link="Homepage";
        }
    }//end if url
    echo $therMsg;
    echo "<div class='alert alert-info'>You will be redirected to $link after $Seconds.</div>";
    header("refresh:$Seconds;url=$url");
    exit();
}
/****************************************************************************************************************************************/
////////////////////////////////////////////////////////////////////
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
/****************************************************************************************************************************************/
/////////////////////////////////////////////////////////////////////
/*
**Get latest Records function 
**function to get  latest items from database[users,items,comments]
**$select=Field to Select
**$table=The table  to choose  from 
**$order=the ordering
**$limit    =number of record to get
*/
function getLatest($select,$table,$order,$limit=5){
    global $con;
    $getstmt=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows=$getstmt->fetchAll();
    return $rows;
}
?>