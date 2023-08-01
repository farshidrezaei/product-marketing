<?php

namespace Database\Factories;

use App\Models\ProductLink;
use App\Models\ProductLinkVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductLinkVisitFactory extends Factory
{
    protected $model = ProductLinkVisit::class;

    public function definition(): array
    {
        return [
            'product_link_id' => ProductLink::factory(),
            'ip' => $this->faker->ipv4,
            'agent' => $this->faker->userAgent,
        ];
    }
}
