<?php
include "dbconfig.php";
if (isset($_POST['username']) && isset($_POST['password'])){

  function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $db_username= validate($_POST['username']);
  $db_password= validate($_POST['password']);

  if (empty($db_username)) {
      header("Location: login_page.php?error=User Name is required");
      exit();
  }else if(empty($db_password)){
      header("Location: login_page.php?error=Password is required");
      exit();
  }else{
      
      $sql="SELECT * FROM User WHERE username='$db_username' AND password='$db_password'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['username'] === $db_username && $row['password'] === $db_password) {
          echo "Logged in!";
        }else{
          header("Location: login_page.php?error=Incorrect Username or password");
          exit();
        }
      }else{
        header("Location: login_page.php?error=Incorrect Username or password");
        exit();

      }
  }  
  
  }else{
      header("Location: login_page.php");
      exit();
  }

    



?>