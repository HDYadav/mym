<?php
if (!function_exists('human_file_size')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function human_file_size($bytes, $decimals = 2)
    {
        $sz = 'BKMGTPE';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sz[$factor];
    }
}

if (!function_exists('Gotra')) {
    function Gotra()
    {
        return  $sl=array(
             '' => '--Select Gotra--',
             '1' => 'Arean',
              '2' => 'Agarwal',
              '3' => 'Airan',
              '4' => 'Aitrichansiya'
        );
    }
}
