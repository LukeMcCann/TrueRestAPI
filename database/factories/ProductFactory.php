<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    protected array $product_images = [
        'jackson_dk2mq.jpg',
        'jackson_soloist.jpg',
        'schecter_c8_silver_mountain.jpg'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, 
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'image' => $this->faker->randomElement($this->product_images),
            'seller_id' => User::InRandomOrder()->first()->id
        ];
    }
}
