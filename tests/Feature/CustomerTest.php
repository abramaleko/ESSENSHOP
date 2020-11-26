<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
   
    /** @test*/ 
    public function ShowProducts()
    {
        $this->withoutExceptionHandling();

        $this->assertDatabaseHas('products',
    [
       'name'=>'iPhone 11',
       'tag'=> 'Electronics', 
    ]);

    }

}
