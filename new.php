<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');

    $errors = array();
    $data = array();
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      
        //validation
        $errors = NewWord::validate($_POST); //object call for validation
        
        if (count($errors) == 0) {

            Flash::set_notice("New word added!"); 
          
            $data = NewWord::open($data); //open and loads book data 
             
            NewWord::append( $data ); //object call to append new data to file

        } else {
            echo "<div class='container'>";
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
    <link rel="stylesheet" href="style/mystyles.css" type="text/css">
</head>
<body>
    <header>
        <div class="container">
            <div class="jumbotron text-center">
            <h1>High Frequency Words</h1>
            </div>
        </div>
        <div class="container">
            <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
                <a href='index.php'>HOME</a>
            </div>
        </div>     
    </header> 
    <main>
        <div class="container">
            <h2>Add Word</h2>
        </div>
        <div class="container">
            <form action='new.php' method='post'>
            <?php   if ( isset( $errors['name'])) {
                        echo "<div class='form-group' id='eb'>";
                    } else {
                        echo "<div class='form-group'>";
                    }      
            ?>
            <label for="name">NEW WORD</label><input class="form-control" type='text' name='word' id='word' value="<?php echo $_POST['word'] ?>">
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
    </footer>
</body>
</html>