<?php
$login = false;
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
  
    include '_dbconnect.php';
    $user_email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];
    
    // $sql = "Select * from users where username = '$username' AND password = '$password'";
    $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_email';";
    $result = mysqli_query($con, $sql); 
    $num = mysqli_num_rows($result);
    if($num == 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($pass, $row['user_pass'])){
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['useremail'] = $user_email;
          $_SESSION['id'] = $row['sno'];
          header("location: /forum/index.php?login=true");
          exit();
        } else{
          $showError  = " Either the username or password is invalid!"; 
          header("location:/forum/index.php?login=false&error=$showError");
          exit();         
        }            
    }else{
      $showError  = " Either the username or password is invalid!";
      header("location:/forum/index.php?login=false&error=$showError");
      exit();
    }
    // header("location:/forum/index.php?login=false&error=$showError");
}
?>