<?php
  session_start();
  require('lib/Flash.php');
  require('lib/NewWord.php');

  $data = array();
  $words = NewWord::open($data);

  $_SESSION['SW'] = '';
  
  $searchWord = $_POST['search'];

  if ( isset($searchWord) ) {
        Flash::set_alert('Word is not in list!');
    foreach ( $words as $word ) {
      if ( $word->word == $searchWord ) {
        Flash::set_notice('Word is in list!');   
      } 
    }
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
    <div class="container">
        <div class="jumbotron text-center mt-3">
            <h1>High-Frequency Words</h1>
        </div> 
    </div>
    
  </header>

  <div class="container">
    <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-between">
      <div class="navbar-brand">Administration</div>
      <div style="width: 100%"></div>
      <div class="navbar-collapse collapse" id="navbarNav">
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

  <div class="container"> 
    
    <form action="admin.php" method="post">
      <div class="form-row align-items-center justify-content-center">
        <div class="col col-sm-8  align-items-center">
          <input class="form-control" type="search" name="search" placeholder="Search Words" aria-label="Search">
        </div>
        <div class="col col-sm-4">
          <button class="btn btn-outline-success w-100" type="submit">Search</button>
        </div>
      </div>
    </form>
     
    </div>
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
              echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
              echo '<p>' . $_SESSION['flash']['message'] . '</p>';
              echo '</div';
              unset($_SESSION['flash']);
              echo '</div>';
              echo '</div>';
          } 
      ?>
   
  </div>

  <main>
    <div class="container text-center px-3">
      <p><span class="bigWords">Click on a word to update or delete</span></p>

      <div class="container" id="scrollBox">
        <div class="row flex-wrap">     
            <?php foreach ($words as $word) :?>
              <div class="col-6 col-sm-4 col-md-2 text-center p-1">
                <?php echo "<a href='edit.php?id=$word->id'>" . $word->word . "</a>"?></div>               
            <? endforeach ?>
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
              echo '</div>';
              echo '</div>';
          } 
      ?>
  </footer>
</body> 
</html>