<?php
  session_start();
  require('lib/Flash.php');
  require('lib/NewWord.php');

  $data = array();
  $data2 = array();
  $words = NewWord::open($data);
  $total = 0;
  $_SESSION['SW'] = '';
  $searchWord = $_POST['word'];

  $sorted = NewWord::alphabetize($data2);

  if ( isset($searchWord) ) {      //message box below search form
    if ( $searchWord != '' ) {
      Flash::set_alert( ucfirst($searchWord) . ' is not in database!');
    }
    foreach ( $words as $word ) {
      if ( $word->word == $searchWord ) {
        Flash::set_notice( ucfirst($searchWord) . ' is in database!' . '<br/>' . 'Scroll to find ' . $searchWord . '!');   
      } 
    }
  }

  foreach ( $words as $word ) {  // generates the number of items in database
    $total += 1;
  }
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
<!-- Jumbotron -->
    <div class="container d-none d-sm-block">
        <div class="jumbotron py-4 text-center mt-3">
            <h1>High-Frequency Words</h1>
        </div> 
    </div>
    
  </header>
<!-- navigation -->
    <div class="container py-2 pb-sm-3">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-between">
        <div class="navbar-brand">Administration</div>
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
              <a class="nav-link" href='new.php'>NEW</a>
            </li>  
            <?php if ( $_SESSION['superUser'] == true ) : ?>
              <li class="nav-item">
                <a class="nav-link" href='addUser.php'>USERS</a>
              </li>
            <? endif ?>
            <li class="nav-item">
              <a class="nav-link" href='logout.php'>LOGOUT</a>
            </li>
          </ul>
        </div>    
      </nav>
    </div>
<!-- search FORM -->
  <div class="container pb-2 pb-sm-3"> 
    <form action="admin.php" method="post">      
      <div class="form-row align-items-center justify-content-center">
        <div class="col col-sm-8  align-items-center">
        <?php if ( count($errors) == 0 ) : ?>
          <input class="form-control" type="search" name="word" placeholder="Search Words" value='<?php echo $searchWord ?>' aria-label="Search">
        <?php else : ?>
          <input class="form-control border border-danger" type="search" name="word" placeholder="Search Words" aria-label="Search">
        <?php endif ?>
        </div>
        <div class="col col-sm-4">
          <button class="btn btn-outline-success w-100" type="submit">Search</button>
        </div>
      </div>
    </form>  
    </div>
<!--  code for flash box -->
    <?php if ($_SESSION['flash']['type'] == 'alert' ) : ?>    <!--  code for flash box -->
        <div class='container'>
        <div class='alert alert-danger text-center'role='alert'>
    <?php endif ?>
    <?php if ($_SESSION['flash']['type'] == 'notice' ) : ?>
        <div class='container'>
        <div class='alert alert-success text-center' role='alert'> 
    <?php endif ?>
      <?php
          if (isset($_SESSION['flash'])) {             
              echo '<p>' . $_SESSION['flash']['message'] . '</p>';
              echo '</div';
              echo '</div>';
              // unset($_SESSION['flash']);
          } 
      ?>
      </div>
  <main>
  <!-- cue and total words -->
    <?php if ( ! isset($_SESSION['flash']) ) : ?>  <!-- click on word message dissapears w/flash set -->
      <div class="container text-center">
        <div class="row  alert alert-info d-inline-block"> 
          <div class="col">
            <p><span class="bigWords">Click on a word to update or delete</span></p>
          </div>
        </div>
      </div>
    <?php endif ?>
    <?php unset($_SESSION['flash']); ?>

      <div class="container text-center"> 
        <div class="row-12"> 
          <div class="col text-center text-sm-left">
            <p>Total words in database: <?php echo $total ?></p> 
          </div> 
        </div>
      </div>
<!-- scroll box -->
    <div class="container" id="scrollBox">
      <div class="row no-gutters flex-wrap py-3">
        <?php foreach ( $sorted as $word ) :?>
          <div class="col-6 col-sm-4 col-md-2 text-center py-1" <?php if ( $word->word == $searchWord || $_GET['id'] == $word->id ) { echo 'style="background-color:#d4edda"';} ?>>
            <?php  echo "<a href='edit.php?id=$word->id'>" . $word->word . "</a>"?>
          </div>               
        <? endforeach ?>
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