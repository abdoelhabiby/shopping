<?php

namespace App\Contracts\Front;

interface HomeIndexContract
{

    public function getProductsOffer($limit);
    public function getNewProducts($limit);
    public function getBestSellers($limit);
    public function getProductsTrending($limit);
    public function getMainCategoriesWithNestedSubcategoriesProducts(int $main_categories_limit = 3,int $products_limit = 9,int $image_count = 2);


}
