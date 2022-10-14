<?php

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





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>customer</h1>
<form action="index.php" method="POST">
  <div class="mb-3">
<label for="fname">ssn:</label><br>
  <input type="text" id="fname" name="ssn" value=""><br>
</div>
<div class="mb-3">
  <label for="lname">first_name:</label><br>
  <input type="text" id="lname" name="first_name" value=""><br>
</div>
<div class="mb-3">
<label for="fname">last_name:</label><br>
  <input type="text" id="fname" name="last_name" value=""><br>
</div>
<div class="mb-3">
  <label for="lname">email:</label><br>
  <input type="text" id="lname" name="email" value=""><br>
</div>
<div class="mb-3">
  <label for="fname">phone_number:</label><br>
  <input type="text" id="fname" name="phone_number" value=""><br>
</div>
<div class="mb-3">
  <!-- <p>last_order</p> <br> -->

  <label for="last_order"> last_Order: </label>

  <select name="last_order" id="last_order">

  <?php
      
  
    // lets learn to name our variables better from now on
    $order_numberSQL = "SELECT order_number FROM `invoice` ";
    //  Cause customer table references invoice table
    // so in customer table last_order field, we show invoice table's ordernumber field
    // thus the foreign key validation completes
    // this can also be seen in phpmyadmin's insert pane for customer table

    // sql ta db te run korale first e ekta table pai amra
    $orderNumber_table = $db->query($order_numberSQL);

    // table oi table je fetchAll kore ante hoy webpage e dekhanor jonno
    // fetchAll() function ekta object return kore
    $orderNumber_object = $orderNumber_table->fetchAll();
      
    // tarpor oi object tar upore loop kore amra ekta ekta kore row pai
    // so ekhaner order_number can be a row as well
    foreach( $orderNumber_object as $row) {
    ?>

      <!-- ekhane row[0] karon invoice table er ekta row er 0-th position e order_nmber ta thake -->
      <option> <?php echo $row[0];?> </option>

    <?php 
    }
      
   ?>
  </select>
</div> 
<div class="mb-3">
  <label for="lname">referrer:</label><br>
  <input type="text" id="lname" name="referrer" value=""><br><br>
</div>
  <input type="submit"  name="publish" value="Publish">
</form> 

<h1>invoice</h1>
<form action="index.php" method="POST">
<label for="fname">order_number:</label><br>
  <input type="text" id="fname" name="order_number" value=""><br>
  <label for="lname">amount:</label><br>
  <input type="text" id="lname" name="amount" value=""><br>
<label for="fname">quantity:</label><br>
  <input type="text" id="fname" name="quantity" value=""><br>
  

  <label for="lname">ssn: </label>
  <select name="ssn" id="ssn">


    <?php
      $ssn_SQL = "SELECT ssn FROM `customer` ";
      // as invoice er ssn customer er ssn ke refer kore
      // so in invoice ssn we are referring ssn of customer

      
      $ssn_table = $db->query($ssn_SQL);
      // getting a table by db query 

      $ssn_object = $ssn_table->fetchAll();
      //fetchAll webpage e show korar jonno use hocche jeta object return kore
      

      foreach( $ssn_object as $rows) {
        // object er upor ekta loop chalacchi
        // ar ekta ekta korey row pacchi
        ?>
    
         
          <option> <?php echo $rows[0];?> </option>
    
        <?php 
        }


      
   ?>
   </select>
  <br>


  <label for="fname">orderdate:</label><br>
  <input type="date" id="fname" name="orderdate" value=""><br><br>
  
  <input type="submit" name="save" value="Save">
</form> 

</body>
</html>


<?php
if(isset($_POST['publish'])) {
    $ssn = $_POST['ssn'];
    $first_name =  $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $last_order =  $_POST['last_order'];
    $referrer = $_POST['referrer'];
   
     
    $query = "INSERT into customer (ssn	,first_name	,last_name ,email ,phone_number	,last_order	,referrer	) VALUES (:ssn	,:first_name	,:last_name ,:email ,:phone_number	,:last_order	,:referrer)";
    
     $query_run = $db->prepare($query);
   
    
   
     $data = [
       ':ssn' => $ssn,
       ':first_name' => $first_name,
       ':last_name' => $last_name ,
       ':email' =>  $email,
       ':phone_number' => $phone_number,
       ':last_order' => $last_order,
       ':referrer' => $referrer,
      
     ];
     
   
     $query_execute = $query_run->execute($data);
   
     if($query_execute){
       $_SESSION['message'] = "inserted successfully";
       header('Location: index.php');
       exit(0);
     }
     else 
     {
       $_SESSION['message'] = "not inserted successfully";
       ('Location: index.php');
       exit(0);
     }   
   
    }
   
   
   ?>
   
   
   <?php
    if(isset($_POST['save'])) {
     $order_number = $_POST['order_number'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $ssn = $_POST['ssn'];
    $orderdate = $_POST['orderdate'];
   
   
    $new_query = "INSERT into invoice ( order_number, amount , quantity ,ssn ,orderdate) values ( :order_number, :amount , :quantity ,:ssn ,:orderdate)";
    $new_query_run = $db->prepare($new_query);
   
    $newdata = [
     ':order_number' => $order_number,
     ':amount' => $amount,
     ':quantity' => $quantity,
     ':ssn' => $ssn,
     ':orderdate' => $orderdate,
   ];
   
   $new_query_execute = $new_query_run->execute($newdata);
   
     if($new_query_execute){
       $_SESSION['message'] = "inserted successfully";
       header('Location: index.php');
       exit(0);
     }
     else 
     {
       $_SESSION['message'] = "not inserted successfully";
      ('Location: index.php');
       exit(0);
     }
   
   
    }
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


    <title>Document</title>
</head>
<body>
    <h1>customerorderdb</h1>
    <table class="content-table">
      <thead>
        <tr>
            <th>ssn</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>phone_number</th>
            <th>last_order</th>
            <th>referrer</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $select_query = "SELECT * FROM ";
 $table = array("customer" , "invoice");
      $sql = "$select_query"."$table[0]";
      $result = $db->query($sql);

      $bati = $result->fetchAll();
      foreach ($bati as $output) {
          // echo $output[2];
          ?>
          <tr>
              <td>
                  <?php 
                  echo $output[0];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[1];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[2];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[3];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[4];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[5];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[6];
                  ?>
              </td>
               <!-- <td>
               <form action="update.php" method="POST">
               <div class="form-action">
               <button type="submit" name="update" class="btn btn-danger">Submit</button>
               </td> -->



               <td>
              
                 <a href="newupdate.php?ssn=<?php echo $output[0];?>" class="btn btn-primary">Edit</a>
                
              </td>  
              <td>
             
              <a href="delete.php?ssn=<?php echo $output[0];?>" class="btn btn-danger">Delete</a>
              
              </td>
          </tr>
          <br>
    <?php 


}


        ?>
      </tbody>
    </table>



   
    <table class="content-table">
      <thead>
        <tr>
            <th>order_number</th>
            <th>amount</th>
            <th>quantity</th>
            <th>ssn</th>
            <th>order_date</th>
           
        </tr>
      </thead>
      <tbody>
        <?php



      $sql = "$select_query".'invoice';
      $result = $db->query($sql);

      $bati = $result->fetchAll();
      foreach ($bati as $output) {
          // echo $output[2];
          ?>
          <tr>
              <td>
                  <?php 
                  echo $output[0];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[1];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[2];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[3];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[4];
                  ?>
              </td>
             

             
          </tr>
          <br>
    <?php 


}


        ?>
      </tbody>
    </table>
</body>
</html>

