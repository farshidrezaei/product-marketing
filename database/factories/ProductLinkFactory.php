<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductLinkFactory extends Factory
{
    protected $model = ProductLink::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'marketer_id' => User::factory(),
            'slug' => $this->faker->slug(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
