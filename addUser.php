<?php
    session_start();
    require('lib/Users.php');
    require('lib/Flash.php');

    $user = array();

    if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

        Flash::set_notice("New user created!");

        $user = Users::open( $_POST );

        Users::append( $user );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AddUser</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style/mystyles.css" type="text/css">
</head>
<header>
    <div class="container">
        <div class="jumbotron text-center">
        <h1>Biag's Store *Admin*</h1>
        </div>
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <a class="home" href="admin.php">MAIN ADMIN</a>
        </div>
    </div>
</header>
<main> 
    <div class="container">
        <h2>Add an authorized user</h2>
    </div>
    <div class="container">
        <form action="addUser.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" value="" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" value="" id="password">
            </div>
                <button  class="btn btn-primary" type="submit">Add</button>        
        </form>
    </div>
    <!-- table of approved users -->
    <div class="container"> 
        <h2>List of approved users</h2>
    </div>
    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>User</th>
                <th>&nbsp;</th>
            </tr>            
            <?php $user = Users::open($_POST); ?>   <!-- populates user table -->
            <?php foreach ($user as $foo) : ?>
                <tr>
                <?php echo "<td>" . $foo->username . "</td>"; ?>                                            
                <td><span><a class="btn btn-primary btn-sm" href="deleteUser.php?id=<?php echo $foo->id ?>">DEL</a></span></td>
                </tr>                       
            <?php endforeach ?>            
        </table>
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
</html>