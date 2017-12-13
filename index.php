<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');
    $data = array();
    $words = NewWord::open( $data );
    $wordsJSON = json_encode( $words, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE );
    $rndNum = '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>FlashCard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
    <script src="js/scripts.js"></script>
</head>

    <script type="text/javascript">
        var words = JSON.parse('<?= $wordsJSON; ?>');                                            
        window.onload = function() { nextWord(words) };
    </script>

<body>
    <header> 
        <div class="jumbotron jumbotron-fluid">
            <div class="container">      
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>High-Frequency Words</h2>
                    </div>
                    <div class="col text-right">
                        <?php if ( $_SESSION['loggedin'] == true && $_SESSION['superUser'] == true ) : ?>
                            <a href='admin.php'>ADMIN</a>
                        <?php endif ?>
                        <?php if ( $_SESSION['loggedin'] == !true ) : ?>
                            <a href="login.php">LOGIN</a>
                        <? endif ?>
                        <?php if ( $_SESSION['loggedin'] == true ) : ?>
                            <a href='logout.php'>LOGOUT</a>
                        <?php endif ?>
                    </div> 
                </div>
            </div>  
        </div> 
    </header>

    <div class="mainContainer">
        <div class="backgroundImage">
            <p id="sightWord"><?php echo $word ?></p>
        </div>
    </div>

    <div id="button">
        <button type="button" onclick="nextWord(words)">NEXT WORD</button>
    </div> 

    <div id="button2">
        <button type="button">SAY WORD</button>
    </div>
    <!-- <footer>
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
    </footer>  -->
</body>
</html>