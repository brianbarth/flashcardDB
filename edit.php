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
            <h1>Administration *EDIT*</h1>
        </div> 
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <a href='logout.php'>LOGOUT</a>
            <a href='admin.php'>MAIN ADMIN</a>
            <a href='index.php'>HOME</a>
            <a href="delete.php?id=<?php echo $hotID ?>">DELETE</a>
            <a href="update.php?id=<?php echo $hotID ?>">UPDATE</a>      
        </div>
    </div> 
  </header>
  <main>
    <div class="container">
      <div class="row"> 
        <div class="col text-center">
          <p id="editWord">Chosen Word: <?php echo $hotWord->word; ?></p> 
        </div> 
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


