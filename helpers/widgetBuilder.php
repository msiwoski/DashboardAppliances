<?php

include_once 'parser.php';
require_once 'config/jsonConfig.php';
/*
 * Given a widget name, calls the appropriate data model, and parses the data
 * into the view and returns the html fragment
 */

/**
 * Build the widget
 * 
 * @Designer: Mat Siwoski
 * @Programmer: Mat Siwoski/Jordan Marling
 * 
 * @param: id of widget
 * @return: String of HTML snippet
 * 
 */
function buildWidget($id) {

    $widget = getWidget($id);

    $_SESSION['widgets'][$id] = time() + $widget['time'];

    require_once "models/{$widget['model']}.php";

    /* get the appropriate data from the given model */
    $widgetModel = new $widget['model']();
    $widgetData = $widgetModel->getData($widget['additionalParams']);

    /* parse the data and get the html fragment for the widget */
    $widgetData['width'] = $widget['width'] * 306 + ($widget['width'] - 1) * 10;
    $widgetData['height'] = $widget['height'] * 306 + ($widget['height'] - 1) * 10;

    if (isset($widget['script']))
        $widgetData['script'] = $widget['script'];
    else
        $widgetData['script'] = "";


    if (isset($widgetData['backgroundImage']))
        $widgetData['backgroundImage'] = "background-image: url(data/images/{$widgetData['backgroundImage']})";
    else
        $widgetData['backgroundImage'] = "";

    $widgetData['id'] = $id;
    $widgetData['content'] = parse($widgetData, $widget['type'] . 'Widget.php');
    $html = parse($widgetData, 'baseWidget.php');

    /* assign the widget id and the html fragment to an array */
    $widgetArray = array(
        'id' => $id,
        'script' => $widgetData['script'],
        'html' => $html
    );

    return $widgetArray;
}
