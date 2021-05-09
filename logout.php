<?php

require_once('connection.php');

try {
    session_start();
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("Location: login.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>