<?php
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/HistoricalController.php";

$objHistController = new HistoricalController();

$url = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );


if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)) {
parse_str($url['query'], $query_strings);
} else {
    $strMethodName = 'listAllAction';
    $objHistController->{$strMethodName}();
}

if ((isset($uri[2]) && $uri[2] != 'historical')) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 
if ((isset($query_strings['start_date']) && isset($query_strings['end_date']))) {

    $begin = $query_strings['start_date'];
    $end = $query_strings['end_date'];

    $dateArr = array($begin, $end);
}

if (isset($query_strings['tickers'])) {
$tickers = $query_strings['tickers'];
if (!empty($tickers)) {
$tickers = "'" . str_replace(",", "','", $tickers) . "'";
}
}

if (!isset($tickers) && !isset($dateArr)) {
    $strMethodName = 'listAction';
$objHistController->{$strMethodName}();
    
}

if (!isset($tickers) && isset($dateArr)) {
    $strMethodName = 'dateRangeAction';
$objHistController->{$strMethodName}($dateArr);
    
}

if (isset($tickers) && isset($dateArr)) {
    $strMethodName = 'dateRangeWithTickersAction';
$objHistController->{$strMethodName}($dateArr, $tickers);
    
}


?>