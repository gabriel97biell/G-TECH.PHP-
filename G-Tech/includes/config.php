<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definindo as constantes do banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hospedagem');


define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/G-tech');
define('ROOT_PATH', __DIR__ . '/..');

try {

    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
    die("Ocorreu um erro. Por favor, tente novamente mais tarde.");
}


function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}


function isAdmin()
{
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}


function redirect($path)
{
    header("Location: " . BASE_URL . $path);
    exit();
}
