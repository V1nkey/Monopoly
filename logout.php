<?php
include_once("models/sessions.php");
unset($_SESSION['auth']);
header("Location: ./");