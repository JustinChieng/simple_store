<?php
    require "includes/functions.php";
    session_start();

    // make sure the user is logged in
    if ( isLoggedIn() ) {
        // delete the user's session data
        logout();
        // redirect user back to login page
        header( 'Location: /login.php' );
        exit;
    } else {
        // redirect to login page if user is not logged in
        header( 'Location: /login.php' );
        exit;
    }