<?php 
    session_start();
    echo $_SESSION["user_id"];
    echo $_SESSION["user_type"];
?>

<a href="../includes/logout.inc.php">LOGOUT</a>

<h3>Profile page recruiters</h3>