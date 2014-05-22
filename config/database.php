<?php
error_reporting(-1);
/* 
 * Database functions used for interacting with the Database
 */
   
require_once 'constants.php';

/**
 * Connect to the Database
 * 
 * @Designer: Mat Siwoski
 * @Programmer:Mat Siwoski
 * 
 * @return: connection to the db
 * 
 */
function connectToDB(){
    $con = pg_connect("host=127.0.0.1 port=5432 dbname=dashboardpg user=team17 password=password");
    /*$con = mysqli_connect(dbHost, dbUser, dbPassword, dbName);
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }*/
    return $con;
}