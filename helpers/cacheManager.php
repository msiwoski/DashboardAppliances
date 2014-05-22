<?php

/**
 * Acts the same as file_get_contents() but first checks the cache to see
 * if the requested url is one the server has cached
 * 
 * If the file is cached, it is returned. Otherwise, the cache has the new
 * entry added to it.
 * 
 * @author  Andrew Burian
 * @param   string  $url    The url data is being requested from
 * @return  string  The data returned from either the cache or the url
 */
function getCachedData($url){
    
    // Hard code the file path
    //$cacheLocation = '/usr/share/nginx/www/DashboardAppliance/data/cache/';
    $cacheLocation = '/var/www/DashboardAppliance/data/cache/';
    // Get the contents of the cache info file
    $string = file_get_contents($cacheLocation . 'cache.json');
    $cacheItems = json_decode($string, true);
    
    // look to see if our file is in cache
    foreach($cacheItems['cache'] as &$item){
        
        if((string)$item['url'] == $url){
        
            // check to see if the data is older than it's refresh rate
            if(time() - $item['updated'] < $item['refresh'] * 24 * 60 * 60){
                
                // data is still fresh, return the data
                return file_get_contents($cacheLocation . $item['file']);
            }
            
            else {
                // data is expired and needs updated
                // get the data from the url
                $newData = file_get_contents($url);
                
                if($newData != false){
                    
                    // data retrieved
                    file_put_contents($cacheLocation . $item['file'], $newData);
                    $item['updated'] = time();
                    file_put_contents($cacheLocation . 'cache.json', json_encode($cacheItems));
                }
                
                return file_get_contents($cacheLocation . $item['file']);
                
            }
        }
    }
    
    // file not cached
    
    // add a new item to the cache
    $newItem = array();
    
    $newItem['url'] = $url;
    $newItem['refresh'] = 1;
    
    // make the new, unique data file
    $lastSlash = strrpos($url, '/') + 1;
    $lastPeriod = strrpos($url, '.');
    if($lastPeriod == false){
        $lastPeriod = strlen($url);
    } else {
        $lastPeriod++;
    }
    $fileName = substr($url, $lastSlash, $lastPeriod - $lastSlash);
    $tmpfilename = $fileName;
    
    for($i = 1; file_exists($cacheLocation . $tmpfilename); $i++){
        $tmpfilename = $fileName . $i;
    }
    
    $newItem['file'] = $tmpfilename;
    
    $newData = file_get_contents($url);
    
    if($newData != false){
        file_put_contents($cacheLocation . $newItem['file'], $newData);
        chmod($cacheLocation . $newItem['file'], 0777);
        $newItem['updated'] = time();
    } else {
        file_put_contents($cacheLocation .  $newItem['file'], 'error retrieving data');
        chmod($cacheLocation . $newItem['file'], 0777);
        $newItem['updated'] = 0;
    }
    
    $cacheItems['cache'][] = $newItem;
    file_put_contents($cacheLocation . 'cache.json', json_encode($cacheItems));
    
    return $newData;
}