<?php
require 'vendor/autoload.php';
Dotenv::load(__DIR__);
Dotenv::required(array("AMAZON_LOGIN_ID","AMAZON_LOGIN_PASS"));
require 'config.php';
