<?php

namespace App\Contracts\Dashboard;

interface HomeIndexContract
{
    /**
     * @return int
     */
    public function getTotalProfit();


    /**
     * @return int
     */
    public function getTotalProductsSoldQuantity();
    /**
     * @return int
     */
    public function getTotalProductsInStockQuantity();

    /**
     * @return int
     */
    public function getNewCustomers();

    /**
     * @param int $dayes
     * @return mixed
     */

    public function getProfitLatestDayes(int $dayes);

    /**
     * @param int $weeks
     * @param  $year
     * @return mixed
     */

    public function getProfitLatestWeek(int $weeks, $year);

    /**
     * @param  $year
     * @return mixed
     */
    public function getProfitByMonths($year);


    /**
     * @param int $limit
     * @return mixed
     */


    /**
     * @param int $dayes
     * @return mixed
     */

    public function getSalesLatestDayes(int $dayes);
    /**
     * @param int $weeks
     * @param  $year
     * @return mixed
     */

    public function getSalesLatestWeek(int $weeks, $year);
    /**
     * @param  $year
     * @return mixed
     */
    public function getSalesByMonths($year);

    public function getProductsNewOrders($limit = 6);


    /**
     * @param int $limit
     * @param int $products_limit
     * @return mixed
     *
     */


    public function getLatestTransactions($limit = 6, $products_limit = 5);


    /**
     * @return float
     */
    public function getTotalProductsSoldAmount();

    /**
     * @return float
     *
     */

    public function getTotalProductsCost();
}
