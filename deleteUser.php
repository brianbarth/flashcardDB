<?php
    session_start();
    require('lib/Flash.php');
    require('lib/Users.php');
    require('lib/Authentication.php');

    Authentication::authenticate();

    $user = array();

    if ( ! isset ($_GET['id'] )) {
        Flash::set_alert( 'The user does not exist!' );
        header('location: ../index.php');
        exit;
    } else {
        Flash::set_notice( 'The user was deleted!' );
    }

    //$user = Users::open( $user );

    Users::remove( $_GET['id'] );
?>