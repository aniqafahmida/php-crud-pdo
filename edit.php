   
<!-- <?php

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Edit data using pdo</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-4">
      <div class="card">
      <div class="card-header">
        <h3>insert data using pdo</h3>
        <a href="index.php" class="btn btn-danger float-end">Back</a>
      </div>
    </div>
    <div class="card-body">
        




      <?php
                if(ISSET($_GET['submit'])){
                   
                    $id = $_GET['ssn'];
                    $sql = $db->prepare("SELECT * FROM `customer` WHERE `ssn`='$id'");
                    $sql->execute();
                    $row = $sql->fetchAll();
                } 
            ?>  

        <?php 

if(ISSET($_GET['submit'])){
                   
  $id = $_GET['ssn'];
  $sql = $db->prepare("SELECT * FROM `customer` WHERE `ssn`='$id'");
  $sql->execute();
  $row = $sql->fetchAll();
}  


        
if(ISSET($_POST['update'])){
 
      $ssn = $_GET['ssn'];
      $first_name = $_POST['first_name'];
      $last_name= $_POST['last_name'];
      $email = $_POST['email'];
       $phone_number = $_POST['phone_number'];
       $last_order = $_POST['last_order'];
       $referrer = $_POST['referrer'];
       try{
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE `user`SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone_number` = '$phone_number' , `last_order` = '$last_order' , `referrer` = '$referrer'  WHERE `ssn` = '$id'";
      $db->exec($sql);
  }catch(PDOException $e){
      echo $e->getMessage();
  }

}
// $first_name = $_POST['first_name'];
// $fname = $_POST['fname'];
// $age = $_POST['age'];
// $id = $_POST['memids'];
// // query
// $sql = "UPDATE customer
//         SET first_name =?, lname=?, age=?
// 		WHERE id=?";
// $q = $db->prepare($sql);
// $q->execute(array($fname,$lname,$age,$id));
// header("location: index.php");


// $get_id=$_REQUEST['ssn'];
 
// $ssn= $_POST['ssn'];
// $first_name= $_POST['first_name'];
// $last_name= $_POST['last_name'];
// $email = $_POST['email'];
// $phone_number = $_POST['phone_number'];
// $last_order = $_POST['last_order'];
// $referrer = $_POST['referrer'];
   
 
// $sql = "UPDATE customer SET ssn= '$ssn', first_name='$first_name', last_name= '$last_name', email= '$email', phone_number= '$phone_number', last_order= '$last_order', referrer= '$referrer'
//  WHERE ssn = '$get_id' ";
// $q = $db->prepare($sql);
// $q->execute(array($first_name,$last_name,$email,$phone_number,$last_order, $referrer));


           
        ?>

      <form action="edit.php" method="POST">
                      <?php
                       
                       
                        $stmt = $db->prepare(
                                "SELECT * FROM customer");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach($users as $user)
                        {
                    ?>
       <div class="mb-3">
        <label>ssn</label>
        <input type="text" name="ssn"  class="form-control">
        </div> -->

        <div class="mb-3">
        <label>first_name</label>
        <input type="text" name="first_name"  <?php echo $user['first_name']; ?>  class="form-control">
        </div>

        <div class="mb-3">
        <label>last_name</label>
        <input type="text" name="last_name" <?php echo $user['last_name']; ?> class="form-control">
        </div>
        <div class="mb-3">
        <label>email</label>
        <input type="text" name="email" <?php echo $user['email']; ?>  class="form-control">
        </div>
        <div class="mb-3">
        <label>phone_number</label>
        <input type="text" name="phone_number" <?php echo $user['phone_number']; ?>  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>last_order</label>
        <input type="text" name="last_order" <?php echo $user['last_order']; ?>  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>referrer</label>
        <input type="text" name="referrer" <?php echo $user['referrer']; ?>  class="form-control"> <br>
        </div>
        <?php
            }
         ?>


        <div class="mb-3">
       
          <button type="submit" name="submit" value="update" class="btn btn-primary">save-btn</button>
         
        </div>
        <?php 
        
          ?>
            
        
        
      </form>
    </div>
      </div>
    </div>
  </div>
   
</body>
</html>



<?php














// $sql = "UPDATE customer SET ssn=:ssn, first_name=:first_name, last_name=:last_name, email=:email, phone_number=:phone_number, last_order=:last_order, referrer=:referrer   WHERE id=:id";
// $result = $db->prepare($sql);
// $res = $result->execute(
//   array(':ssn' =>  $_POST['ssn'],
//   ':first_name' => $_POST['first_name'],
//   ':last_name' => $_POST['last_name'],
//   ':email' =>  $_POST['email'],
//   ':phone_number' => $_POST['phone_number'],
//   ':last_order' => $_POST['last_order'],
//   ':referrer' => $_POST['referrer'],
   
//     'ssn' 			=> $_GET['ssn']
//   ));

// if(isset($_GET['id'])) 
// {
//     $customer_id = $_GET['id'];
    
//     $query = "SELECT * FROM `customer` WHERE id= :cust_id LIMIT 10001";
//     $statement = $db->prepare($query);
//     $data= [':cust_id' => $customer_id];
//     $statement->execute($data);

//     $result = $statement->fetch(PDO::FETCH_OBJ); 


  
//     if($statement->execute([':ssn' => $ssn ,':first_name' => $fist_name , ':last_name' => $last_name , ':email' => $email , ':phone_number' => $phone_number , ':last_order' => $last_order , ':referrer' => $referrer])) {
//         $msg = 'data inserted';
    
//    }


   
// }


  ?> -->

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


<form action="update.php" method="GET">
    




      <?php
      $stmt = $db->prepare(
      "SELECT * FROM customer");
      $stmt->execute();
      $users = $stmt->fetchAll();
      foreach($users as $bati)
       {
        ?>
      <!-- <div class="mb-3">
        <label>ssn</label>
        <input type="text" name="ssn"  class="form-control">
        </div> -->
        <?php
            }
         ?>

         <div class="mb-3">
        <label>first_name</label>
        <input type="text" name="first_name"  value="<?php echo $bati[1]; ?>"  class="form-control">
        

        <div class="mb-3">
        <label>last_name</label>
        <input type="text" name="last_name" value="<?php echo $bati[2]; ?>" class="form-control">
        </div>
        <div class="mb-3">
        <label>email</label>
        <input type="text" name="email" value="<?php echo $bati[3]; ?>"  class="form-control">
        </div>
        <div class="mb-3">
        <label>phone_number</label>
        <input type="text" name="phone_number" value="<?php echo $bati['4']; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>last_order</label>
        <input type="text" name="last_order" value="<?php echo $bati['5']; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>referrer</label>
        <input type="text" name="referrer" value="<?php echo $bati['6']; ?>"  class="form-control"> <br>
        </div>
       


        <div class="mb-3">
       
          <button type="submit" name="submit" value="update" class="btn btn-primary">update</button>
         
        </div>
        <?php 

// $id = $_GET['ssn'];

// $first_name = $_POST['first_name'];
// $last_name= $_POST['last_name'];
// $email = $_POST['email'];
// $phone_number = $_POST['phone_number'];
// $last_order = $_POST['last_order'];
// $referrer = $_POST['referrer'];



// $sql = "UPDATE customer
// 		SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone_number = '$phone_number' , last_order = '$last_order' , referrer = '$referrer'
// 		WHERE ssn = $id ";

// if ( $db->query($sql) ) {
// 	session_start();
// 	$_SESSION['msg'] = 'Update Successfully.';
// 	header("Location: update.php?id=" . $id);
// }
// echo $rn = $_GET['rn'];
// echo $fn = $_GET['fn'];
// $ln = $_GET['ln'];
// $em = $_GET['em'];
// $pn = $_GET['pn'];
// $tn = $_GET['tn'];

//  $sql="UPDATE customer SET first_name=?, last_name=?, email=? , phone_number =? , last_order = ? , referrer = ? WHERE ssn=?";$stmt=$db->prepare($sql);$stmt->execute([$bati[1],$bati[2],$bati[3],$bati[4] , $bati[5] , $bati[6]]);


        // if(ISSET($_POST['submit'])){
             
        //     $sql = "UPDATE customer
        // SET first_name=?, last_name=?, email=? , phone_number =? , last_order = ? , referrer = ?
		// WHERE ssn=?";
        //     // $sql = "UPDATE `user`SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone_number` = '$phone_number' , `last_order` = '$last_order' , `referrer` = '$referrer'  WHERE `ssn` = '$id'";
        //     $q = $db->prepare($sql);
        //     $q->execute(array($bati[1],$bati[2],$bati[3],$bati[4],$bati[5], $bati[6]));
          
        //     header("location: index.php");

        


        //     $id = $_GET['ssn'];
        //     $first_name = $_POST['first_name'];
        //     $last_name= $_POST['last_name'];
        //     $email = $_POST['email'];
        //      $phone_number = $_POST['phone_number'];
        //      $last_order = $_POST['last_order'];
        //      $referrer = $_POST['referrer'];
        //      try{
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     $sql = "UPDATE `user`SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone_number` = '$phone_number' , `last_order` = '$last_order' , `referrer` = '$referrer'  WHERE `ssn` = '$id'";
        //     $db->exec($sql);
        // }catch(PDOException $e){
        //     echo $e->getMessage();
        // }
      
      
          ?>
            
        
        
      </form>
    </div>
      </div>
    </div>
  </div>
   
</body>
</html>
