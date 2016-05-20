<?php

/**
 * @author Ta Van Chinh
 * @copyright 2016
 */
echo '<pre>';
$url = 'vpc_Amount=85593&vpc_Version=1&vpc_OrderInfo=Holidaysvietnam_1603_15283_18&vpc_Command=queryDR';
parse_str($url, $array);
print_r($array);
die;
?>