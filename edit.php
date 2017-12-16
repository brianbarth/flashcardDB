<?php
  session_start();
  require('lib/NewWord.php');
  require('lib/Flash.php');
  $hotID = $_GET['id'];
  $data = array();
  //$words = NewWord::open( $data );
  $hotWord = NewWord::find( $hotID ); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AdminPage</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<!-- Jumbotron -->
  <header>
    <div class="container">
        <div class="jumbotron py-4 text-center mt-3">
            <h1>High-Frequency Words</h1>
        </div> 
    </div>
  </header>
<!-- navigation -->
  <div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-between">
      <div class="navbar-brand">Edit Page</div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div style="width: 100%"></div>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">HOME <span class="sr-only"></span></a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="admin.php">ADMIN</a> 
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="update.php?id=<?php echo $hotID ?>">UPDATE</a> 
          </li> 
            <li class="nav-item">
              <a class="nav-link" href="delete.php?id=<?php echo $hotID ?>">DELETE</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href='logout.php'>LOGOUT</a>
          </li>
        </ul>
      </div>    
    </nav>
  </div>
<!-- edit word and links -->
  <main>
    <div class="container">
      <div class="row"> 
        <div class="col text-center">
          <p id="editWord">Selected Word: <span class="spanWords"><?php echo $hotWord->word; ?></p></span> 
        </div> 
      </div>
      <div class="row pb-3">
        <div class="col text-center">
          <a href="update.php?id=<?php echo $hotID ?>"><button type="button" class="btn btn-primary">Update</button></a>
        </div>
      </div>
      <div class="row"> 
        <div class="col text-center"> 
          <a href="delete.php?id=<?php echo $hotID ?>"><button type="button" class="btn btn-danger">Delete</button></a>
        </div>
      </div> 
    </div> 
  </main>

  <footer>
  <div class='container-fluid mt-4 pt-6 bg-light text-dark fixed-bottom'>
      <div class='row justify-content-center'> 
        <div class'col'> 
          <p>Copyright &copy 2017 Brian Barth</p> 
        </div> 
      </div> 
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
  </html> 


