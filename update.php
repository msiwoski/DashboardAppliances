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

session_start();

// Session is already started
if($_SESSION['dashboardTime'] <= time()){
    buildDashboard();
    exit;
}

update();
