<?php
   $dsn="mysql:host=localhost;dbname=workshop";
   $user="root";
   $pass="";
   $option=array(
       PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'//arabic language,
   );
//connect to database 
  try{
      $con=new PDO($dsn,$user,$pass,$option);
      $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo "sorry <br>" .$e;
}
//end
?>