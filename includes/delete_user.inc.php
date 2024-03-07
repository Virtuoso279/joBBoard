<?php

session_start();

require_once "../classes/Dbh.php";
require_once "../classes/models/SignUp.model.php";
require_once "../classes/controllers/SignUp.contr.php";

//create temp user
$tempUser = new SignUpContr("tmp@gmail.com", "123456789");
$tempUser->cancelReg();

session_unset();
session_destroy();

// Going back to the signup page
header("Location: ../signup.php?error=none");
