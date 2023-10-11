<?php
var_dump($_REQUEST);
$resultIndicator =$_REQUEST['resultIndicator'];
$sessionVersion = $_REQUEST['sessionVersion'];

file_put_contents('getproductlink.log',print_r($_REQUEST,true).'\n',FILE_APPEND);


?>