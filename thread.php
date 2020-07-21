<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>iDiscuss</title>
  </head>
  <body>
    <?php
        include "partials/_header.php";
        include "partials/_dbconnect.php";
    ?>

    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_id` = '$id'";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $user_id = $row['thread_user_id'];
        }

        $sql2 = "SELECT user_email FROM `users` WHERE `sno` = '$user_id'";
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
    ?>

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>These forums define spam as unsolicited advertisement for goods, services and/or other web sites, or posts with little, or completely unrelated content. Do not spam the forums with links to your site or product, or try to self-promote your website, business or forums etc.
Spamming also includes sending private messages to a large number of different users.p>
            <p><strong>Posted by: <?php echo $row2['user_email']; ?></strong></p>
        </div>
    </div>
    
    <?php
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
            echo '<div class="container my-3">
                <h2>Post a Comment</h2>
                <form action = "'. $_SERVER['REQUEST_URI'].'"method = "post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type your comment</label>
                        <input type="text" name = "comment" class="form-control" id="exampleInputEmail1">
                        <input type="hidden" name="sno" value="'. $_SESSION['id']. '">
                    </div>
                    <button type="submit" class="btn btn-success">Comment</button>
                </form>
            </div>';
        }else{
            echo "<div class = 'container'><h2>Please log in to post a reply!!</h2></div>";
        }    

    ?>
    <!--Insert-->
    <?php
        $showAlert = false;
        $showError = false;
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);

            $sno = $_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
            
            $result = mysqli_query($con, $sql);  
            if($result){
        //        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //        <strong>Success!</strong>Thanks for signing up!
        //        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //          <span aria-hidden="true">&times;</span>
        //        </button>
        //    </div>';
            } else{
               echo "error!";
            }
        }    
    ?>
    <!--DISPLAY-->
    <div class="container">
        <h2>Discussions</h2>
        <?php
            // $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE `thread_id` = '$id'";
            $result = mysqli_query($con, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $comment = $row['comment_content'];
                $date = $row['comment_time'];
                $user_id = $row['comment_by'];
                
                $sql2 = "SELECT user_email FROM `users` WHERE sno = '$user_id';";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);


                echo '<div style = "padding-bottom: 20px;"class="media my-3">
                    <img class="mr-3" width = "54px"  src="img/user.jpg">

                    <div class="media-body ">
                    <p class = "font-weight-bold my-0">'. $row2['user_email'] .' '. $date .' </p>
                        '. $comment .'
                    </div>
                </div>';
            }       
            if($noResult){
                echo "<p style = 'padding-bottom: 100px;' ><b>Be the First person to comment!</b></p>";
            }
        ?>
    </div>
    <?php
        include "partials/_footer.php";
    ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>