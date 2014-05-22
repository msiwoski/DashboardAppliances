<?php

/**
 * Gets the dashboards associated with a client
 * 
 * @author  Andrew Burian
 * @param   mixed $clientId       The id of the client
 * @return  array               An array of dashboard id's
 */
function getDashboardList($clientId){
    $string = file_get_contents('data/clients.json');
    $data = json_decode($string, TRUE);
    
    foreach($data['clients'] as $client){
        if($client['id'] == $clientId){
            return $client['dashboards'];
        }
    }
    
    return null;
}

/**
 * Gets the widgets associated with a dashboard
 * 
 * @author  Andrew Burian
 * @param   mixed $dashboardId      The id of the client
 * @return  array                   An array of widget id's
 */
function getDashboardInfo($dashboardId){
    $string = file_get_contents('data/dashboards/' . $dashboardId . '.json');
    $data = json_decode($string, true);
    return $data;
}

/**
 * Gets the information of a single widget
 * 
 * @author  Andrew Burian
 * @param   mixed $widgetId         The id of the widget
 * @return  array                   An array of widget properties
 */
function getWidget($widgetId){
    $string = file_get_contents('data/widgets/' . $widgetId . '.json');
    $data = json_decode($string, true);
    return $data;
}
