<?php
session_start();

// $_SESSION = [];

// Destroy all sessions
session_unset();
session_destroy();
setcookie(session_name(), "", time() - 3600, "/");

// Prevent browser from caching the page
// header("Cache-Control: no-cache, must-revalidate");
// header("Expires: 0");

// Redirect to login page
header("Location:../");
exit();
?>
