<?php
date_default_timezone_set('PST8PDT');
/**
 * Twitter Account Info
 */
//Twitter oauth_access_token
define("oauthToken","106260297-IDffszTR7F4HUipEAANkRIoYKnJD4LI0bTi9BLUZ");
//Twitter oauth_access_token_secret
define("oauthSecret","A0Nd8DMxiOxFbaKssKD2Q0gboptbor5VjaXZHRZt1Bah4");
//Twitter consumer_key
define("consumerKey","ArsfdwnQTngsNnxHskdwS5xAr");
//Twitter consumer_secret
define("consumerSecret","LQBMb6gDb5dtxpjOyaPsfrPnC8HaVDghcPwu7ZmNVpesMUJojT");

/* 
 * Test twitter model to display twitter feed
 */
require_once 'baseModel.php';
require_once 'helpers/twitterAPIExchange.php';


/**
 * Gets the twitter information for the client and displays the correct
 * information on the widget. The desired information is the tweet, 
 * name and profile image. Only the most recent tweet is used.
 * 
 * @author  Mat Siwoski
 * @return  String  An associative array of parameters to be used on the view
 */
class twitterModel extends baseModel {
    
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    var $settings = array();
    
    /**
     * Constructor for the twitter model.
     * Set the correct API token info.
     * 
     * @author  Mat Siwoski
     */
    function __construct(){
        $this->settings = array(
            'oauth_access_token' => oauthToken,
            'oauth_access_token_secret' => oauthSecret,
            'consumer_key' => consumerKey,
            'consumer_secret' => consumerSecret
        );
    }
    
    /**
     * Set the correct parameter information.
     * 
     * @author  Mat Siwoski 
     */
    function getData($widgetParams) {
        $params = array();
        $params['title'] = "City of Vancouver Twitter Feed";
       
           
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=CityofVancouver';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->settings);
        
        $response = $twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                            ->performRequest();
        
        $data = (array)json_decode($response);
        $first= (array)$data[0];
        $user = (array)$first['user'];
        $params['profile_img'] = $user['profile_image_url'];
        $params['screen_name'] = $user['screen_name'];
        $params['text'] = $first['text'];
        $params['time'] = date("H:i", strtotime($first['created_at']));
        //$params['screen_name'] = $data[0]->user->screen_name;  
        //$params['text'] = "\"{$data[0]->text}\"";
        //$params['time'] = date("H:i:s", strtotime($data[0]->created_at));
        
        
        $params['backgroundImage'] = "bgTwitter.png";
        $params['backgroundColor'] = "#1AB2E8";
        
        return $params;
    }
	
}
