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
  # eta onno page theke astese tai only ssn hobe
  
   
  


    
    

?>


<form action="update.php" method="POST">
    




      <?php
      $ssn = $_GET['ssn'];
      $stmt = $db->prepare(
        "SELECT `first_name`, `last_name`, `email`, `phone_number`, `last_order`, `referrer` FROM `customer` WHERE ssn = $ssn");
      
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
        <input type="text" name="first_name"  value="<?php echo $bati[0]; ?>"  class="form-control">
        

        <div class="mb-3">
        <label>last_name</label>
        <input type="text" name="last_name" value="<?php echo $bati[1]; ?>" class="form-control">
        </div>
        <div class="mb-3">
        <label>email</label>
        <input type="text" name="email" value="<?php echo $bati[2]; ?>"  class="form-control">
        </div>
        <div class="mb-3">
        <label>phone_number</label>
        <input type="text" name="phone_number" value="<?php echo $bati[3]; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>last_order</label>
        <input type="text" name="last_order" value="<?php echo $bati[4]; ?>"  class="form-control"> 
        </div>
        <div class="mb-3">
        <label>referrer</label>
        <input type="text" name="referrer" value="<?php echo $bati[5]; ?>"  class="form-control"> <br>
        </div>
       


        <div class="mb-3">
          <form action="update.php" method="POST">
          <button type="submit" name="update" id ="update" value="update" class="btn btn-primary">update</button>
          </form>
         
         
        </div>
         <?php 
             
             if(isset($_POST['update'])) {
                $id = $_GET[`ssn`];  
               
        
         
            # esob thik ache 100% SURE OK
        
             $sql_update = "UPDATE customer set first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', email='" . $_POST['email'] . "', 
             phone_number='" . $_POST['phone_number'] . "' WHERE ssn='" . $id . "'";
            
            #$sql_update = "UPDATE customer set first_name=:first_name, last_name=:last_name, email=:email, phone_number=:phone_number WHERE ssn=:id";
           
              
               
            #UPDATE `customer` SET `first_name` = 'test', `last_name` = 'test2' WHERE `customer`.`ssn` = 10004 GET METHOD WORK KORE NA
            
           // $sql_update = "UPDATE customer set first_name=?, last_name=? , email = ? , phone_number = ? , last_order = ? , referrer = ? WHERE ssn = ?";
            #$sql_update = "UPDATE customer set first_name=:first_name WHERE ssn = :ssn";
            $pdoResult = $db->prepare($sql_update);
            $pdoExec = $pdoResult->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'],$_POST['phone_number'],$_POST['last_order'],$_POST['referrer'], $id]);
            #$pdoExec = $pdoResult->execute(array('first_name' => $_GET['first_name'], 'ssn' => $id));
            # ei execution e vul thakte pare. only place ETA TO BASIC VUL HOWAR KOTHA NA, THAKLE EI LAst query  PART VUL as i am not sure why its not
        
            echo $_POST['first_name'];
            ECHO $pdoExec;
            if($pdoExec)
            {;
                echo 'Record Modified Successfully';
            }else{
                echo 'ERROR';
            }
        
            }  
               
               ?>
          
            
        
        
      </form>
    </div>
      </div>
    </div>
  </div>
   
</body>
</html>


