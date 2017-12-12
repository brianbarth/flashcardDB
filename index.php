<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');
    //require('js/scripts.js');
    $data = array();
    $words = NewWord::open($data);
    $wordsJSON = json_encode($words);
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
        var words= JSON.parse('<?= $wordsJSON; ?>')                                            
        window.onload = function() {nextWord(words)};
    </script>

<body>
    <header> 
        <div class="jumbotron jumbotron-fluid">
            <div class="container">      
                <div class="row">
                    <div class="col text-left">
                        <h2>High-Frequency Words</h2>
                    </div>
                    <div class="col text-right">
                        <a href='admin.php'>ADMIN</a>
                        <?php if ( $_SESSION['loggedin'] == !true ) : ?>
                            <a href="login.php">Login</a>
                        <? endif ?>
                        <?php if ( $_SESSION['loggedin'] == true ) : ?>
                            <a href='logout.php'>Logout</a>
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