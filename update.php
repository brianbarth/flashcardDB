<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');
   
    $data = NewWord::find( $_GET['id'] );

    if (! $data) {                     //is there a product? creates error message and redirects
        Flash::set_alert("The product could not be found");
        header ("location:admin.php");
        exit;
    }
    
    if ( sizeof($errors) == 0 ) {
        $id = $data->id;
        $name = $data->word;                 
    }   
       
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        
        $errors = NewWord::validate($_POST); //validation

        if ( sizeof($errors) === 0) {  
            $data->update($_POST); // update function to write new data to db       
            Flash::set_notice("The Word was updated!");         
            header( "location:admin.php?id=" . $data->id ); // redirects after writing 
            exit;
            
        } else {
            echo "<div class='container text-center'>";
            echo "<div class='alert alert-danger'role='alert'>";
            foreach ($errors as $foo) {         // validation-- prints error messages
                echo $foo . "</br>";
            }
            echo "</div>";
            echo "</div>";

            $word = isset($_POST['word']) ? $_POST['word'] : null;
        }
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UpdatePage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<header>
    <div class="container">
        <div class="jumbotron py-4 text-center mt-3">
            <h1>High-Frequency Words</h1>
        </div> 
    </div>
</header> 
    <div class="container pb-4">
        <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-between">
        <div class="navbar-brand">Update Word</div>
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
    <div class="container">
        <form action="update.php?id=<?php echo $data->id ?>" method='post'>
            <?php   if ( isset( $errors['word'])) {
                            echo "<div class='form-group' id='eb'>";
                        } else {
                            echo "<div class='form-group'>";
                        }
            ?>
            <label for="name">
                <?php echo 'selected word: ' . $name ?>
            </label>
                <input class="form-control" type='text' name='word' id='word' value="<?php echo $word ?>">
            </div>
                <button class="btn btn-primary" type='submit'>Update</button>
        </form>
    </div>
</main>
<footer>
</footer> 
</html>