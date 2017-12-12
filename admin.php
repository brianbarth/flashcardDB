<?php 
  session_start();
  require('lib/Flash.php');
  require('lib/NewWord.php');
  $data = array();
  $words = NewWord::open($data);

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
            <h1>Administration</h1>
        </div> 
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <a href='logout.php'>LOGOUT</a>
            <a href='new.php'>NEW</a>
            <a href='index.php'>HOME</a>
            <?php if ( $_SESSION['superUser'] == true ) : ?>
              <a href='addUser.php'>USERS</a>
            <? endif ?>
        </div>
    </div> 
  </header>
  <main>
    <div class="container">
      <p>Click on a word to edit or delete</p>
    <div class="container">
      <div class="row flex-wrap">
      <?php foreach ($words as $word) : ?>
        <div class="col-2">
          <?php echo "<a href='edit.php?id=$word->id'>" . $word->word . "</a>" ?>
        </div>               
      <? endforeach ?>
      </div>
    </div>
  </main> 
  <footer>
    <?php
        if (isset($_SESSION['flash'])) {          // here for future development  
            echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
            echo '<p>' . $_SESSION['flash']['message'] . '</p>';
            echo '</div';
            unset($_SESSION['flash']);
        } 
    ?> 
  </footer>
</body>
</html>