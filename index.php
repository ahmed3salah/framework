<?php
# start the php session
session_start();


/**
 *  Composer Autoload
 *   This file will autoload all the app files
 */
require __DIR__ .'/vendor/autoload.php';

# load required files
include_once('./Loader.php');

# reset the session values
// Session::ResetSession()
?>
