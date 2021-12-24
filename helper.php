<?php
session_start();
// check is login
function isLoged($redirect = false, $to = null)
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    if ($redirect) {
        header('location: ' . ($to ?? 'sign-in.php'));
    }
    return false;
}

// function check admin
function isAdmin()
{
    if (isLoged()) {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            return true;
        }
        return false;
    } else {
        header('location: sign-in.php');
        exit();
    }
}
?>