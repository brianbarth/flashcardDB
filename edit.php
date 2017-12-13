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
  <header>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>High-Frequency Words</h1>
        </div> 
    </div>
  </header>
  <div class="container">
    <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-between">
      <div class="navbar-brand">Edit Page</div>
      <div style="width: 100%"></div>
      <div class="navbar-collapse collapse" id="navbarNav">
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
  <main>
    <div class="container">
      <div class="row"> 
        <div class="col text-center">
          <p id="editWord">Selected Word: <span class="spanWords"><?php echo $hotWord->word; ?></p></span> 
        </div> 
      </div> 
    </div> 
  </main>
  <footer>
    <?php if ($_SESSION['flash']['type'] == 'alert' ) : ?>
        <div class='container'>
        <div class='alert alert-danger text-center'role='alert'>
    <?php endif ?>
    <?php if ($_SESSION['flash']['type'] == 'notice' ) : ?>
        <div class='container'>
        <div class='alert alert-success text-center' role='alert'> 
    <?php endif ?>
      <?php
          if (isset($_SESSION['flash'])) {             
              echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
              echo '<p>' . $_SESSION['flash']['message'] . '</p>';
              echo '</div';
              unset($_SESSION['flash']);
          } 
      ?>
      </div>
      </div>
  </footer>
  </body>
  </html> 


