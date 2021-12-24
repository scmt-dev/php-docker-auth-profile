<?php
session_start();
session_destroy();

// go to login
header('location: sign-in.php');