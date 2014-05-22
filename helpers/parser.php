<?php

/* 
 * View Template Parser
 */


/**
 * Parses the given template, replacing every instance of '{key}' with 'val' in 
 * the given params array
 * 
 * @author Jordan Marling
 * 
 * @param type $params  an array of template elements to parse
 * @param type $view    the name of the file in /views to parse
 * @return string   The transformed template
 */
function parse($params, $view){
    
    $l_delim = '{';
    $r_delim = '}';
    
    $template = file_get_contents('views/' . $view);
    
    if(!is_array($params)){
        return "";
    }
    
    foreach($params as $key => $val){
        $template = str_replace($l_delim . $key . $r_delim, $val, $template);
    }
    
    return $template;
}
