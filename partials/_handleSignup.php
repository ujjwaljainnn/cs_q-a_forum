<?php
  include "_dbconnect.php";
?>

<?php
    $showAlert = "false";
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $signupEmail = $_POST['signupEmail'];
        $password = $_POST['signupPassword'];
        $cpassword = $_POST['signupCPassword'];
        
        $existSql = "SELECT * FROM `users` WHERE `user_email` = '$signupEmail'";
        $result = mysqli_query($con, $existSql);  
        $numRowsExist = mysqli_num_rows($result);
        if($numRowsExist > 0){
            $showError = " Email already exists!";
        } else{
            if($cpassword == $password){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`sno`, `user_email`, `user_pass`, `timestamp`) VALUES (NULL, '$signupEmail', '$hash', current_timestamp());";
                $result = mysqli_query($con, $sql); 
                if($result){      
                    $showAlert = "account registered!";   
                    header("Location: /forum/index.php?signupsuccess=true");
                    exit();
                }
            }else{
                 $showError  = " Passwords don't match!";
                
            }
        }
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");
        
    }
?>