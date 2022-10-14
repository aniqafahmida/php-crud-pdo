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
}catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
exit();
}
?>
<?php
   
    if(isset($_POST['update'])) {
        $ssn =  $_POST['ssn'];
        //$id = $_POST['ssn'];
        $first_name =  $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $last_order =  $_POST['last_order'];
        $referrer = $_POST['referrer'];
        
        $query = "UPDATE customer SET  first_name='$first_name', last_name= '$last_name', email= '$email',
         phone_number= '$phone_number', last_order= '$last_order', referrer= '$referrer' WHERE ssn = $ssn";
        // $query = "INSERT into customer (first_name	,last_name ,email ,phone_number	,last_order	,referrer	) VALUES (:first_name	,:last_name ,:email ,:phone_number	,:last_order	,:referrer)";
        
        $query_run = $db->prepare($query);
        
        $pdoExec = $query_run->execute();
        
        //  $data = [
        
        //    ':first_name' => $first_name,
        //    ':last_name' => $last_name ,
        //    ':email' =>  $email,
        //    ':phone_number' => $phone_number,
        //    ':last_order' => $last_order,
        //    ':referrer' => $referrer,
        
        //  ];
        
        
        //  $query_execute = $query_run->execute($data);
        
        if($pdoExec){
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
// $ssn = $_GET['ssn'];
// echo $ssn;
// $first_name =  $_POST['first_name'];
// echo $first_name;
// // php update data in mysql database using PDO

// if(isset($_POST['update']))
// {
   
    
//     // get values form input text and number
    
//     $first_name =  $_POST['first_name'];
//     $last_name = $_POST['last_name'];
//     $email = $_POST['email'];
//     $phone_number = $_POST['phone_number'];
//     $last_order =$_POST['last_order'];
//     $referrer = $_POST['referrer'];
     
    

   
//     $query = "UPDATE `invoice`SET `order_number` = ':order_number' WHERE `ssn` = $ssn ";
//     $queryResult = $db->prepare($query);
//     $queryExec = $queryResult->execute([$_POST_['order_number']]);
//    //  $queryExec = $queryResult->execute(array(":order_number" => $order_number));
//     $my_query = "UPDATE customer SET  first_name='$first_name', last_name= '$last_name', email= '$email', phone_number= '$phone_number', last_order= '$last_order', referrer= '$referrer'";

//    // $query = "UPDATE `users` SET `fname`=:fname,`lname`=:lname,`age`=:age WHERE `id` = :id";
    
//     $pdoResult = $db->prepare($my_query);
//     $pdoExec = $pdoResult->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'],$_POST['phone_number'],$_POST['referrer'], $ssn]);
//    // $pdoExec = $pdoResult->execute(array(":first_name"=>$first_name,":last_name"=>$last_name,":email"=>$email,":phone_number" => $phone_number , ":referrer" => $referrer));
    
//     if($pdoExec)
//     {
//         echo 'Data Updated';
//     }else{
//         echo 'ERROR Data Not Updated';
//     }

// }

?>


      


<?php
  
$ssn = $_GET['ssn'];
echo $ssn;

$stmt = $db->prepare("SELECT * FROM `customer` WHERE ssn = $ssn");

   // ("SELECT `first_name`, `last_name`, `email`, `phone_number`, `last_order`, `referrer` FROM `customer` WHERE ssn = $ssn");
    $stmt->execute();
    $users = $stmt->fetchAll();
    foreach($users as $bati) {
        
  
        }

        // echo $bati[0];
        // echo $bati[1];
        // echo $bati[2];
        // echo $bati[3];
        // echo $bati[4]; 
      
    

?>

<form action="newupdate.php" method="POST">
       
        <input type="hidden" name="ssn"  value="<?php echo $bati[0]; ?>"  class="form-control">
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
        <input type="text" name="phone_number" value="<?php echo $bati[4]; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>last_order</label>
        <input type="text" name="last_order" value="<?php echo $bati[5]; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>referrer</label>
        <input type="text" name="referrer" value="<?php echo $bati[6]; ?>"  class="form-control"> <br>
        </div>
       
   
        <button type="submit" name="update" id ="update" value="update" class="btn btn-primary">update</button>
        
      

    </form>


 
       <?php
        ?>
          

          <?php
          
   
      
        // if(isset($_POST['update'])) {
        //     //  $id = $_POST['ssn'];
        //     $first_name = $_POST['first_name'];
        //     $last_name= $_POST['last_name'];
        //     $email = $_POST['email'];
        //     $phone_number = $_POST['phone_number'];
        //     $last_order = $_POST['last_order'];
        //     $referrer = $_POST['referrer'];
    
            
        //    $sql_update = "UPDATE customer SET first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', email='" . $_POST['email'] . "', phone_number='" . $_POST['phone_number'] . "' , referrer='" . $_POST['referrer'] . "' WHERE ssn='" . $id . "'";
        //    $pdoResult = $db->prepare($sql_update);
        //    $pdoExec = $pdoResult->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'],$_POST['phone_number'],$_POST['last_order'],$_POST['referrer'], $id]);
   

        //    echo $_POST['first_name'];
        //   if($pdoExec)
        //   {;
        //      echo 'Record Modified Successfully';
        //   }else{
        //      echo 'ERROR';
        //   }
        // }
        ?>