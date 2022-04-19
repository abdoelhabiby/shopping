<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Category::truncate();


        $m_data = [
            'slug' => 'clothes',
            'en' => ['name' => 'clothes'],
            'ar' => ['name' => 'ملابس'],
        ];

        $main_category = Category::create($m_data);
        //-------------------------------------------------

        $s_data = [
            'slug' => 'man-clothes',
            'parent_id' => $main_category->id,
            'en' => ['name' => 'man clothes'],
            'ar' => ['name' => 'ملابس رجالي'],
        ];

        $sub_category = Category::create($s_data);
        //-------------------------------------------------

        $c_data = [
            'slug' => 'tshirt',
            'parent_id' => $sub_category->id,
            'en' => ['name' => 'tshirt'],
            'ar' => ['name' => 'تيشيرت'],
        ];

        $sub_category = Category::create($c_data);


        //-------------------seconde category-------------------------------


        $m_data = [
            'slug' => 'computer',
            'en' => ['name' => 'computer'],
            'ar' => ['name' => 'كمبيوتر'],
        ];

        $main_category = Category::create($m_data);
        //-------------------------------------------------

        $s_data = [
            'slug' => 'laptop',
            'parent_id' => $main_category->id,
            'en' => ['name' => 'laptop'],
            'ar' => ['name' => 'لابتوب'],
        ];

        $sub_category = Category::create($s_data);
        //-------------------------------------------------

        $c_data = [
            'slug' => 'laptop-games',
            'parent_id' => $sub_category->id,
            'en' => ['name' => 'laptop-games'],
            'ar' => ['name' => 'لابتوب العاب'],
        ];

        $sub_category = Category::create($c_data);




    }
}
