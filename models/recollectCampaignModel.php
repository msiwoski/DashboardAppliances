<?php

require_once 'baseModel.php';
require_once 'helpers/recollectAPI.php';

class recollectCampaignModel extends baseModel {
	
	function getData($widgetParams) {
		
		$params = array();
		$params['title'] = "";
		//Confirmed Working
                $params['text'] = getRecollectMessage($widgetParams);
		$params['footer'] = "";
		
		$params['backgroundImage'] = "bgRecollect.png";
		$params['backgroundColor'] = "#347602";
		
		return $params;
		
	}
	
}
