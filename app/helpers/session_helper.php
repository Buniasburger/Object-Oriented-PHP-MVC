<?php
session_start();

// Flash message helper
// EXAMPLE: flash('register_success', 'You are now registered', 'alert alert-danger')
// DISPLAY IN VIEW - <?php echo flash('register_success');
function flash($message = '', $class = 'alert alert-success')
{
    if ($message) {
        $_SESSION['class'] = $class;
        $_SESSION['message'] = $message;
    } elseif (!empty($_SESSION['message'])) {
        echo "<div class=\"{$_SESSION['class']}\">{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}