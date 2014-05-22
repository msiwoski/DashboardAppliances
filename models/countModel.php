<?php

require_once 'baseModel.php';
require_once 'helpers/recollectAPI.php';

/**
 * Widget count model that displays the count of specified location search term and time period
 *
 * @author  Mat Siwoski
 */
class countModel extends baseModel {

    /**
     * Set the correct parameter information.
     *
     * @author  Mat Siwoski
     */
    function getData($widgetParams) {

        $amount = getRecollectCount($widgetParams["city"], $widgetParams["category"], $widgetParams["time"]);
        $prior = $amount['prior'];
        $last = $amount['last'];
        $change = $last - $prior;
        if ($prior > 0){
            $percent = ($change / $prior) * 100;
        }
        else {
            $percent = $change * 100;
        }
        $params = array();
        $params['title'] = $widgetParams["title"];
        $params['text'] = $last;
        $params['percentage'] = abs(ceil($percent)) . "% vs. " . $widgetParams["comparePeriod"];

        $params['footer'] = "Last updated on " . date("D M j");
        $params['footerColor'] = $widgetParams["footerColor"];
        $params['backgroundColor'] = $widgetParams["backgroundColor"];
        if (ceil($percent) > 0) {
            $params['arrowImage'] = 'data/images/up.png';
        } else if (ceil($percent) < 0) {
            $params['arrowImage'] = 'data/images/down.png';
        } else {
            $params['arrowImage'] = 'data/images/noChange.png';
        }
        return $params;
    }

}
