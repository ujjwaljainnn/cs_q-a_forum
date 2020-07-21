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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>These forums define spam as unsolicited advertisement for goods, services and/or other web sites, or posts with little, or completely unrelated content. Do not spam the forums with links to your site or product, or try to self-promote your website, business or forums etc.
Spamming also includes sending private messages to a large number of different users.p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <?php
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
            echo '<div class="container my-3">
                <h2>Start a Discussion</h2>
                <form action = "'. $_SERVER['REQUEST_URI'].'" method = "post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problem Title</label>
                        <input type="text" name = "title" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="desc">Elaborate the problem</label>
                        <textarea name = "desc" id = "desc" rows = "3" class="form-control"></textarea>
                        <input type="hidden" name="sno" value="'. $_SESSION['id']. '">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
        }else{
            echo "<div class = 'container'><h2>Please log in to post a question!!</h2></div>";
        }
    ?>
    <?php
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $sno = $_POST['sno'];


            $title = str_replace("<", "&lt;", $title);
            $title = str_replace(">", "&gt;", $title);
            $title = str_replace("'", "\'", $title);
            
            $desc = str_replace("<", "&lt;", $desc);
            $desc = str_replace(">", "&gt;", $desc);
            $desc = str_replace("'", "\'", $title);


            $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES (NULL, '$title', '$desc', '$id', '$sno', current_timestamp());";
            


            $result = mysqli_query($con, $sql);  
            if($result){
                echo "record entered!";
            }else{
                echo "error!";
            }
        }    
    ?>
    <div class="container">
        <h2>Browse Questions</h2>
        <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = '$id'";
            $result = mysqli_query($con, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $id = $row['thread_id'];
                $user_id = $row['thread_user_id'];
                $time = $row['timestamp'];
                $sql2 = "SELECT user_email FROM `users` WHERE sno = '$user_id';";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                

                $noResult = false;
                echo '<div style = "padding-bottom: 20px;"class="media my-3">
                    <img class="mr-3" width = "54px"  src="img/user.jpg">
                    <div class="media-body ">
                        <h5 class="mt-0"><a class = "text-dark" href = "thread.php?threadid='.$id.'">'. $title .'</a></h5>
                        '. $desc .'
                        <p>'. $row2['user_email'] .' at '. $time .' </p>
                    </div>
                    
                </div>';
            }       
            if($noResult){
                echo "<p style = 'padding-bottom: 100px;' ><b>Be the First person to ask a question!</b></p>";
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