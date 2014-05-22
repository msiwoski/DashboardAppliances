<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once "helpers/dashboardBuilder.php";

//buildDashboard();

//require_once "helpers/recollectAPI.php";

//echo getRecollectMessage("olathe");

require_once 'helpers/cacheManager.php';
require_once 'helpers/recollectAPI.php';

//echo getCachedData("http://recollect.net/api/dashboard/coquitlam/services/waste/count/supportrequests/11day");
$gdata[] = getSearchesGraphData('vancouver', 'supportrequests', 11);
var_dump($gdata);
//echo getRecollectSearches('vancouver');
