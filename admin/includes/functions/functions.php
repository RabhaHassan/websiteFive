<?php
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
/*
**count number of items function  
**function  to count  number  of items rows
**$item =the item  to count
**$table = the table  to choose  from 
*/
function  countItem($item,$table){
    global $con;
    $stmt2=$con->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}


?>