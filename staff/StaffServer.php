<?php
require_once('./../config.php');
session_start();

// initialize variable in case of duplication
$INSTR_EMAIL = "";
$errors = array();

$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);