<?php

/**
 * The abstract base for every data model
 */
abstract class BaseModel{
    
    /**
     * Should reuturn an associative array of data, where each key is a name
     * of a template element that will be replaced with the corresponding value.
     */
    abstract function getData($params);
}
