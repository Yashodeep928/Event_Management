<?php
session_start();


include './config/db.php';


// SIGNUP FORM
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
  
    $email = $_POST['email'];
    $password = $_POST['password'];
  
     $insertquery = "INSERT INTO register (username, email, password) VALUES ('$username', '$email', '$password')";
  
    $stmt = $pdo->prepare($insertquery);
  
     if($stmt->execute()){
      
       echo"Registration successfull";
    }
    else{
      echo "Error: ";

    }

        
  }

?>
