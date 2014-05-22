<?php

require_once 'baseModel.php';
require_once 'helpers/recollectAPI.php';

class textModel extends baseModel {

    function getData($widgetParams) {


        $params = array();
        $params['title'] = "Recent Weekly Searches";
        $params['text'] = "Hi";
        //Confirmed working
        //$params['text'] = getRecollectCount($widgetParams, "reminders", "1week");

        $params['footer'] = "Last updated on " . date("D M j");

        $params['backgroundColor'] = "#aaa";

        return $params;
    }

}
