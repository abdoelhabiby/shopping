<?php


namespace App\Interfaces\Front;


interface HomeRepositoryInterface
{

    public function getProductsOffer($limit);
    public function getNewProducts($limit);
    public function getBestSellers($limit);
    public function getProductsTrending($limit);
    public function getThreeMainCategoriesWithChieldsProducts(int $chields_count = 3,int $products_count = 4);

}
