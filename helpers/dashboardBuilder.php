<?php
error_reporting(-1);
/* 
 * Given a dashboard id, calls the widgetBuilder as nessesary and puts it all
 * into an html fragment.
 * Then calls the responseBuilder to send it to the client
 */

require_once 'config/database.php';
require_once 'helpers/widgetBuilder.php';
require_once 'helpers/responseBuilder.php';
require_once 'config/jsonConfig.php';

/**
 * Build the dashboard
 * 
 * @Designer:  Mat Siwoski/Andrew Burian/Jordan Marling
 * @Programmer: Mat Siwoski
 * 
 * @return: void
 * 
 */
function buildDashboard(){
	
	$_SESSION['widgets'] = array();
	
    //Get the total number of Widgets
    $dashboardList = getDashboardList($_SESSION['clientID']);
    
    $dashboardInfo = getDashboardInfo($dashboardList[$_SESSION['currentDashboard']]);
    
    //hold snippet of html
    $response = array();
//    $response = "<widget><h1><span>{$dashboardInfo['name']}</span></h1></widget>";
    
    //get the list of widgets on the current dashboard
    $widgets = getWidgets($dashboardInfo['widgets']);
    $response[] = array('html'=> "<h1><span>{$dashboardInfo['name']}</span></h1>", "id" => 'title');
    
    
    //build html snippet
    foreach($widgets as $widget){
        $response[] = $widget;
    }
    
    //Send Response to Client
    sendDashboard($response);
    
    //set the next update time of the dashboard
    $_SESSION['dashboardTime'] = time() + ($dashboardInfo['time'] * 60);
    
    //go to the next dashboard on the list
    $_SESSION['currentDashboard']++;
    if ($_SESSION['currentDashboard'] >= count($dashboardList)) {
		$_SESSION['currentDashboard'] = 0;
	}
}

/**
 * Get the number of widgets for the dashboard
 * 
 * @Designer: Mat Siwoski
 * @Programmer: Mat Siwoski
 * 
 * @param: $connection - connection to the database
 */
function getWidgets($widgetList){
    $widgets = array();
    
    foreach ($widgetList as $widget){
        $widgets[] = buildWidget($widget);
    }
    return $widgets;
}
