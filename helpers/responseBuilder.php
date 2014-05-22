<?php

/*
 * Takes in the data to be send to the client and makes an xml response that the
 * client can parse
 */

/**
 * Send the Dashboard to the client
 * 
 * @Designer: Jordan Marling
 * @Programmer: Jordan Marling
 * 
 * @param: String of HTML snippet
 * 
 */
function sendDashboard($widgetArray) {
//    $response = new SimpleXMLElement("<response>$html</response>");
//    $response->addAttribute('type', 'dashboard');
//    echo $response->asXML();
    
    $response = array();
    $response['type'] = 'dashboard';
    $response['widgets'] = $widgetArray;
    echo json_encode($response);
}

/**
 * Send the widget to the client
 * 
 * @Designer: Jordan Marling
 * @Programmer: Jordan Marling 
 *  
 * @param: Associated array of widgets
 * 
 */
function sendWidget($widgets) {
//    $content = "<response>";
//    foreach ($widgets as $widget) {
//        $content .= $widget;
//    }
//    $content.= "</response>";
//
//    $response = new SimpleXMLElement($content);
//    $response->addAttribute('type', 'widget');
//    echo $response->asXML();
    $response = array();
    $response['type'] = 'widget';
    $response['widgets'] = $widgets;
    echo json_encode($response);
}

/**
 * Send the page reload to the client
 * 
 * @Designer: Jordan Marling
 * @Programmer: Jordan Marling 
 *  
 * @param: Associated array of widgets
 * 
 */
function sendPageReload() {
    $response = new SimpleXMLElement("<response></response>");
    $response->addAttribute('type', 'reload');
    echo $response->asXML();
}
