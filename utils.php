<?php

session_start();

function view($viewName)
{
    require 'views/start_view.php';
    require "views/$viewName.php";
    require 'views/end_view.php';

    return true;
}

function error($errorMessage)
{
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    $_SESSION['errors'][] = $errorMessage;
}

function message($message)
{
    if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = [];
    }
    $_SESSION['messages'][] = $message;
}


function redirect_with_error($location, $error)
{
    error($error);
    return redirect($location);
}


function redirect_with_success($location, $message)
{
    message($message);
    return redirect($location);
}

function redirect($location)
{
    header("Location: $location");
    return true;
}

$__database = null;

function getConnection()
{
    global $__database;

    if ($__database == null) {
        $__database = new PDO('mysql:host=localhost;dbname=newsfeed', 'root', 'root', [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    }
    return $__database;
}

function dd($expression)
{
    var_dump($expression);
    die();
}