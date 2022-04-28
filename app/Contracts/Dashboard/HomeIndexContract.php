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
    public function getTotalProductsSold();


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

    public function getProductsNewOrders($limit = 6);


      /**
     * @param int $limit
     * @param int $products_limit
     * @param int $categories_limit
     * @return mixed
     *
     */


    public function getLatestTransactions($limit=6,$products_limit=5,$categories_limit=2);

}
