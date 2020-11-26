<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => 'Iphone 11',
            'description' => $this->faker->text,
            'image_path'=>$this->faker->imageUrl(640,300,'iPhone',false),
            'stock' => $this->faker->randomDigit(),
            'new_price' => '800000',
            'tag'=>'Electronics',

        ];
    }
}
