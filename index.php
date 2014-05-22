<?php

/**
 * The landing site for all incoming client requests
 *
 * @author  Andrew Burian
 * @author  Jordan Marling
 * @date    April 30, 2014
 */

require_once 'controllers/widgetUpdater.php';
require_once 'helpers/dashboardBuilder.php';
require_once 'helpers/parser.php';

// check to ensure the client has sent their ID with the request
if(!isset($_GET['id'])){
    echo "No id, rejected";
    exit;
}

// start use of the client's session
session_start();

// check to see if this is the client's first connection
//if(!isset($_SESSION['active'])){
    $_SESSION['active'] = true;
    $_SESSION['currentDashboard'] = 0;
    $_SESSION['dashboardTime'] = time(); // set the time to update now, so the client can get the dashboard.
    $_SESSION['clientID'] = $_GET['id'];
    $_SESSION['widgets'] = array();
    
    // echo the first time html shell
    $view = array();
    echo parse($view, 'main.php');
    //exit;
//}
