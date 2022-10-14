<?php

session_start();

$dbname = "customerorderdb";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost:3366";



try{
  $db = new PDO("mysql:host=".$dbhost.";dbname=$dbname", $dbuser, $dbpass);
  // // set the PDO error mode to exception
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}
?> 


<?php
if (isset($_GET['ssn'])) {
$id = $_GET['ssn'];
$stmt = $db->query('SELECT * FROM customer');
$row_count = $stmt->rowCount();

if($row_count >= 1) {
   
    $pdoQuery = "DELETE FROM `invoice` WHERE `ssn` = :id";

    $pdoResult = $db->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
    if($pdoExec)
    {
       echo 'Invoice Data Deleted';
       
       
    }else{
       echo 'ERROR Data Not Deleted';
   
     
       
    }
   
} else {
    'errorr';
}



    $pdoQuery = "DELETE FROM `customer` WHERE `ssn` = :id";

    $pdoResult = $db->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
    if($pdoExec)
    {
       echo 'Customer Data Deleted';
       header('Location: index.php');
     
      
    }else{
       echo 'ERROR Data Not Deleted';
       // header('Location: index.php');
      
     
    }

}

// $id = $_GET['ssn'];
  
//     $last_query = "DELETE FROM `customer` WHERE `last_order` = :id";

//     $pdoQuery = "DELETE FROM `customer` WHERE `ssn` = :id";
    
//     $pdoResult = $db->prepare($pdoQuery);
    
//     $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
//     if($pdoExec)
//     {
//         echo 'Data Deleted';
//     }else{
//         echo 'ERROR Data Not Deleted';
//     }


?>




