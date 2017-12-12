<?php
    session_start();
    require('lib/Flash.php');
    require('lib/Users.php');
    
    $bad = false;
    $data = array();
    $user = array();

    $validUser = Users::open( $user );

    if ( isset( $_POST['username'], $_POST['password'] ) ) {
        $bad = true;
        if ( $_POST['username'] == 'Brian' && $_POST['password'] == 'Words' ) {
            $_SESSION['loggedin'] = true;
            $_SESSION['superUser'] = true;
            $_SESSION['user'] = $_POST['username'];
        
            Flash::set_notice( 'Hello Brian, you are now logged in!');
            header('location:admin.php');
            exit;
        }
        if ( $_POST['username'] != 'Brian' ) {
            foreach ( $validUser as $foo ) {
                if ( ( $_POST['username'] == $foo->username ) && ( $_POST['password'] == $foo->password ) ) {
                    $_SESSION['superUser'] = false;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $_POST['username'];
               
                    Flash::set_notice( 'You are now logged in!');
                    header('location:admin.php');
                    exit;
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
    <header>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Flash Card Admin *LOGIN*</h1>
        </div> 
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <a href='index.php'>HOME</a>
        </div>
    </div>
        <?php if ( $bad ) : ?>
            <div class="container">
                <div class="well well-md text-center" style="background-color: #f8d7da;"><p>The Username or password is not correct</p></div>
            </div>
        <?php endif ?>
    </header> 
    <main>    
        <div class="container">
            <h2>Please Login:</h2>
        </div>
        <div class="container">
            <form action='login.php' method='post'>
            <div class="form-group">
                <label for 'username'>USERNAME</label> 
                <input class="form-control" type ='text' name ='username' value ='' id='username'>
            </div>
            <div class="form-group">
                <label for 'password'>PASSWORD</label> 
                <input class="form-control" type = 'password' name = 'password' value = '' id = 'password'> 
            </div>
                <button class="btn btn-primary" type = 'submit'>Login</button>               
            </form>
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
</html>