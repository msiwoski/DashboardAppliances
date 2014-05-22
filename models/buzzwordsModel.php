<?php

require_once 'baseModel.php';

/**
 * Buzzword model allowing information to be displayed to the user
 * as a list of information.
 * 
 * @author  Damien Sathanielle
 */
class buzzwordsModel extends baseModel {

    /**
     * Set the correct parameter information.
     * 
     * @author  Damien Sathanielle 
     */
    function getData($widgetParams) {

        $params = array();
        $params['title'] = "Buzzwords";

        $params['olabel'] = "Garbage: ";
        $params['olvalue'] = "9000 times";

        $params['olabel2'] = "Trash: ";
        $params['olvalue2'] = "1 times";

        //$params['ulable'] = "more stuff";
        //$params['ulvalue'] = "0101000100";
        $params['backgroundColor'] = "#e064fc";


        $params['footer'] = "Words Spoken";

        return $params;
    }

}
