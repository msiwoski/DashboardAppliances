<?php

/** 
 * Helper file with functions that will be used throughout the server.
 * 
 */

$csvFile = "testdata_delete/community_centres.csv";

/**
 * Parse the CSV File for the information.
 * Usze the fgetcsv
 * 
 * @Designer: Mat Siwoski
 * @Programmer: Mat Siwoski
 * 
 * @param: CSV File
 * @return: Associated Array of Data from the file
 * 
 */
function parseCSV($csvFile){
   $row = "";
   echo $csvFile;
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            //var_dump($handle);
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
            }
         fclose($handle);
     }else {
        echo "error";
    }
}