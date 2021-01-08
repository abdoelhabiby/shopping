<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    /** @test */

    public function it_should_retern_dublicate_entry_user_id()
    {
        $user = auth()->attempt([
            "email" => 'user@user.com',
            'password' => '123456789'
        ]);
        $data = [
            // "product_id" => 13,
            // "user_id" => 1,
            "title" => 'ewwe',
            "quality" => 1,
            "review" => 'review'

        ];

        $response = $this->post('/en/product/tshrit-black-2/review',$data);

        // $url = route('teti');



          dd($response);

        $response->assertStatus(200);

    }
}
