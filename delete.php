<?php
    session_start();
    require('lib/NewWord.php');
    require('lib/Flash.php');

    $words = array();
    $hotID = $_GET['id'];
    
    if ( ! isset ($_GET['id'])) {
        Flash::set_alert("The word could not be found");
        header ('location:admin.php');
        exit;
    } else {
        Flash::set_notice("The word was deleted!");
    }
          
    NewWord::remove($hotID);  // removes the product from the database by using the $_GET['id']
?>