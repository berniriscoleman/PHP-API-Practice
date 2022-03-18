<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class HistoricalModel extends Database
{
    public function getAllHistoricalData()
    {
            return $this->select("SELECT name, ticker, d, high, low, close FROM companies JOIN historical ON companies.company_id = historical.company_id");
     
    }

    public function getHistoricalDataByDateRange($dateArr)
    {
            return $this->select("SELECT name, ticker, d, high, low, close FROM companies JOIN historical ON companies.company_id = historical.company_id WHERE historical.d BETWEEN '$dateArr[0]' AND '$dateArr[1]'");
    }

    public function getHistoricalDataByTickersDateRange($dateArr, $tickers)
    {
        if (empty($tickers)) {
            $results =  $this->select("SELECT name, ticker, d, high, low, close FROM companies JOIN historical ON companies.company_id = historical.company_id WHERE historical.d BETWEEN '$dateArr[0]' AND '$dateArr[1]'");
        } else {
            $results = $this->select("SELECT name, ticker, d, high, low, close FROM companies JOIN historical ON companies.company_id = historical.company_id WHERE historical.d BETWEEN '$dateArr[0]' AND '$dateArr[1]' AND ticker IN ($tickers)");
        }
        return $results;
    }
}