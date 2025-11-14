<?php
/**
 * WYLOGOWANIE
 * Niszczy sesję i wylogowuje użytkownika
 */

define('APP_ACCESS', true);
require_once '../config.php';
require_once 'functions.php';

initSession();

// Zniszcz wszystkie dane sesji
$_SESSION = [];

// Jeśli używamy cookies sesyjnych, usuń je
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Zniszcz sesję
session_destroy();

// Przekieruj na stronę główną
header('Location: ../index.php');
exit;
