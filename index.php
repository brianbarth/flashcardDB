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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <script src="js/scripts.js"></script>
</head>

    <script type="text/javascript">
        var words = JSON.parse('<?= $wordsJSON; ?>');                                            
        window.onload = function() { nextWord(words) };
    </script>

<body>
<!-- jumbotron -->
    <header>      
        <div class="container">      
            <div class="jumbotron py-1 py-sm-4 text-center mt-3">        
                <div class="row">
                    <div class="col">
                        <h1>High-Frequency Words</h1>
                    </div>
                </div>
            </div> 
        </div>        
    </header>
<!-- navigation -->
    <div class="container pb-4">
        <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-between">
        <div class="navbar-brand">HOME</div>
        <div style="width: 100%"></div>
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ( $_SESSION['loggedin'] == true && $_SESSION['superUser'] == true ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href='admin.php'>ADMIN</a>
                    </li>
                    <?php endif ?>
                <?php if ( $_SESSION['loggedin'] == !true ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">LOGIN</a>
                    </li>
                <? endif ?>
                <?php if ( $_SESSION['loggedin'] == true ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href='logout.php'>LOGOUT</a>
                    </li>
                <?php endif ?>   
            </ul>
        </div>    
        </nav>
    </div>
<!-- word container -->
    <div class='container bg-light'>
        <div class='row'>
            <div class='col mh-75 m-auto'>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <p id="sightWord"><?php echo $word ?></p>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'> 
            <div class='col-6 col-sm-4'>
                <button class="btn btn-primary w-100 my-4" type="button" onclick="nextWord(words)">NEXT WORD</button>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class='col-6 col-sm-4 pb-4'>
                <button class="btn btn-primary w-100 mb-4" id='button2' type="button">SAY WORD</button>
            </div>
        </div>
    </div>

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