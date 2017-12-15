<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');
    $data = array();
    $errors = array();
    $data = NewWord::open($data);
    $test = true;

    foreach ( $data as $word ) {   // checks for repeated entries before submitting
        if ( $_POST['word'] == $word->word ) {
            $test = false;
            $_POST['word'] = '__';
        }
    }
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      
        //validation
        $errors = NewWord::validate($_POST); //object call for validation
        
        if ( (count($errors)) == 0 && ($test == true) ) {

            Flash::set_notice("New word added!"); 
              
            NewWord::append(); //object call to append new data to file

        } else {
            echo "<div class='container my-2'>";
            echo "<div class='alert alert-danger text-center' role='alert' style='background-color:#f8d7da;'>";
            foreach ( $errors as $mssg ) {
                echo $mssg . "</br>";
            }
            echo "</div>";
            echo "</div>";
            
        } //end of loop that prints $errors array
    } // end of $_POST control statement

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewWord</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<!-- jumbotron container -->
    <header>
        <div class="container">
            <div class="jumbotron py-4 text-center mt-3">
            <h1>High-Frequency Words</h1>
            </div>
        </div> 
    </header>
<!-- navigation -->
        <div class="container">
            <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-between">
                <div class="navbar-brand">New Word</div>
                <div style="width: 100%"></div>
                <div class="navbar-collapse collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">ADMIN</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">HOME <span class="sr-only"></span></a>
                        </li>     
                    </ul>
                </div>    
            </nav>
        </div> 
    <main>
<!-- FORM for adding new word -->
        <div class="container">
            <form class="padding" action='new.php' method='post'>
            <?php   if ( isset( $errors['name'])) {
                        echo "<div class='form-group' id='eb'>";
                    } else {
                        echo "<div class='form-group'>";
                    }      
            ?>
            <label for="name">ADD WORD</label>

            <?php if ( count($errors) == 0 ) : ?>
                <input class="form-control" type='text' name='word' id='word' value=''>
            <?php else : ?>
                <input class="form-control border border-danger" type='text' name='word' id='word' value=''>
            <?php endif ?>

            </div>
            <?php   if ( isset( $errors['description'])) {
                        echo "<div class='form-group' id='eb'>";
                } else {
                    echo "<div class='form-group'>";
                }      
            ?>
                <button class="btn btn-primary" type='submit'>Add</button> 
            </form>
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
</body>
</html>