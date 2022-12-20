<?php

function connectToDB()
{
    return new PDO(
        'mysql:host=localhost;dbname=simple_store',
        'root',
        'root'
    );
}

$database = connectToDB();

function isLoggedIn()
{
    return isset( $_SESSION['user'] );
}

function logout()
{
    unset( $_SESSION['user'] );
}