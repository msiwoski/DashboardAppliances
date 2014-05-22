<?php

/**
 * Used to interact with the Recollect API
 */
/*
 * Examples:
 * https://recollect.net/api/dashboard/vancouver/services/waste/message
 * https://recollect.net/api/dashboard/olathe/services/waste/message
 */
require_once 'cacheManager.php';

/**
 * Get the current city message
 * 
 * @author  Robin Hsieh
 * @param   string  The location for the current message 
 */
function getRecollectMessage($location) {
    $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/message");
    $data = json_decode($contents, TRUE);

    return $data['html'];
}

/*
 * Examples:
 * https://recollect.net/api/dashboard/olathe/services/waste/count/supportrequests/1day
 * https://recollect.net/api/dashboard/olathe/services/waste/count/supportrequests/1week
 * https://recollect.net/api/dashboard/olathe/services/waste/count/supportrequests/1month
 * https://recollect.net/api/dashboard/olathe/services/waste/count/supportrequests/3months
 */
/**
 * Get the support requests for the city, current or from a set time length
 * 
 * @author  Robin Hsieh
 * @param   string  The location of the support requests 
 * @param   string  The time period for the data
 */
function getRecollectSupportRequests($location, $timePeriod) {
    $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/count/supportrequests/{$timePeriod}");
    $data = json_decode($contents, TRUE);

    return $data;
}

/*
 * Examples:
 * https://recollect.net/api/dashboard/olathe/services/waste/count/searches/1week
 * https://recollect.net/api/dashboard/olathe/services/waste/count/reminders/1week
 * https://recollect.net/api/dashboard/olathe/services/waste/count/notifications/1week
 */
/**
 * Get the count for searches/reminders/notifications for a city for a specific time
 * period.
 * 
 * @author  Robin Hsieh
 * @param   string  The location for the count 
 * @param   string  The type of service requested (ex. searches/reminders/notifications)
 * @param   string  The length of time period desired 
 */
function getRecollectCount($location, $category, $timePeriod = null) {
    if ($timePeriod == null) {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/count/{$category}");
        $data = json_decode($contents, TRUE);
    } else {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/count/{$category}/$timePeriod");
        $data = json_decode($contents, TRUE);
    }

    return $data;
}

/*
 * Examples:
 * Since the start of the month: https://recollect.net/api/dashboard/vancouver/services/waste/activity/reminders?since=2014-05-01  
 * Since 11am PST, today: https://recollect.net/api/dashboard/vancouver/services/waste/activity/reminders?since=2014-05-12+11:00:00+-08
 */
/**
 * Get the recollect reminders for a time period.
 * 
 * @author  Robin Hsieh
 * @param   string  The location of the reminders 
 * @param   string  The time period for the data
 */
function getRecollectReminders($location, $timePeriod = null) {
    if ($timePeriod == null) {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/activity/reminders");
        $data = json_decode($contents, TRUE);
    } else {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/activity/reminders?since={$timePeriod}");
        $data = json_decode($contents, TRUE);
    }
    return $data;
}

/*
 * Examples:
 * Since the start of the month: https://recollect.net/api/dashboard/vancouver/services/waste/activity/searches?since=2014-05-01  
 * Since 11am PST, today: https://recollect.net/api/dashboard/vancouver/services/waste/activity/searches?since=2014-05-12+11:00:00+-08
 */
/**
 * Get the searches for a time period.
 * 
 * @author  Robin Hsieh
 * @param   string  The location of the searches 
 * @param   string  The time period for the data
 */
function getRecollectSearches($location, $timePeriod = null) {
    if ($timePeriod == null) {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/activity/searches");
        $data = json_decode($contents, TRUE);
    } else {
        $contents = getCachedData("https://recollect.net/api/dashboard/{$location}/services/waste/activity/searches?since={$timePeriod}");
        $data = json_decode($contents, TRUE);
    }
    return $data;
}

/*
 * Example:
 * getSearchesGraphData("olathe", "searches", "5");
 * will return array(5) { [0]=> int(217) [1]=> int(259) [2]=> int(235) [3]=> int(139) [4]=> int(119) }
 */
/**
 * Get the count for a given number of days.
 *
 * @author  Robin Hsieh
 * @param   string  The location of the searches
 * @param   string  The category for the data
 * @param   string  The number of days to retrieve data for
 */
function getSearchesGraphData($location, $category, $numberOfDays) {
    /* how many days worth of data */
    $dayContents = array();
    for ($i = 0; $i < $numberOfDays; $i++) {
        $temp = getRecollectCount($location, $category, ($i + 1) . "day");
        $dayContents[] = $temp['last'];
    }
    /* subtract the days to get individual values per day */
    $dayData[0] = $dayContents[0];
    for ($i = 0; $i < $numberOfDays - 1; $i++) {
        $dayData[] = $dayContents[$i + 1] - $dayContents[$i];
    }

    return $dayData;
}

