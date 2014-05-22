<?php

require_once 'baseModel.php';
require_once 'helpers/recollectAPI.php';

class infoModel extends baseModel {

    function getData($widgetParams) {


        $params = array();
        $params['title'] = $widgetParams['title'];
        $params['text'] = $widgetParams['text'];
        //Confirmed working
        //$params['text'] = getRecollectCount("olathe", "reminders", "1week");

        $params['footer'] = "Last updated on " . date("D M j");

        $params['backgroundColor'] = "#347602";

        return $params;
    }

}
