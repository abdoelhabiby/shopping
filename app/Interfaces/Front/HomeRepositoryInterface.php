<?php


namespace App\Interfaces\Front;


interface HomeRepositoryInterface
{

    public function getProductsOffer($limit);
    public function getNewProducts($limit);

}
