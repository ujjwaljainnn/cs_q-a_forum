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
        $sql = 'SELECT * FROM threads WHERE (thread_title) LIKE ("%'. $_GET['search'] .'%") || (thread_desc) LIKE ("%'. $_GET['search'] .'%")';
        $result = mysqli_query($con, $sql);
    ?>
    <div class="container my-3 mb-5">
        <h1>Search Results for "<em><?php echo $_GET['search']; ?></em>"</h1>
        <div class="results">
            <?php
                $noresults = true;
                while($row = mysqli_fetch_assoc($result)){
                    $noresults = false;
                    $thread_title = $row['thread_title'];
                    $thread_desc = $row['thread_desc'];
                    $thread_id = $row['thread_id'];

                    echo '<h3><a href="/forum/thread.php?threadid='.$thread_id.'" class="text-dark">'. $thread_title.'</a></h3>';
                    echo '<p>'. $thread_desc .'</p>';
                }
                
                if($noresults){

                    echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Search Results Found</p>
                            <p class = "lead">Check spelling or type a new query.</p>
                        </div>
                    </div>';
                }
            ?>
        </div>
      
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