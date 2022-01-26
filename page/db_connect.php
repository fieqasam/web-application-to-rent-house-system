<?php

//define constant variables
define('DB_NAME', 'web_application_to_rent_house');
define('DB_USER', 'root');
define('DB_PASSWORD','');
define('DB_HOST', 'localhost');

try{
    //connection variable
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //encode language
    mysqli_set_charset($con, 'utf8');
}catch(Exception $ex){
    print "An Exception occured. Message: ".$ex->getMessage();
} catch(Error $e){
    print "The system is busy please try later";
}