<?php

include 'helpers/responseBuilder.php';
include 'helpers/widgetBuilder.php';
/* 
 * Given a widget id, loads the model, gets the dataset for the widget, and
 * calls the responseBuilder to send the data back to the client
 */

/*
 * Update the widget
 * 
 * @Designer: 
 * @Programmer:
 * 
 */
function update(){
	
	$widgetData = array();
	
	foreach ($_SESSION['widgets'] as $id => $time) {
		if ($time >= time()) {
			$widget = buildWidget($id);
			$widgetData[] = $widget;
		}
	}
	
    /* send the widget to the client */
    sendWidget($widgetData);
}
