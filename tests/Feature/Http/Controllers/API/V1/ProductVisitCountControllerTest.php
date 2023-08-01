<?php

namespace Tests\Feature\Http\Controllers\API\V1;

use App\Models\ProductLink;
use App\Models\ProductLinkVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductVisitCountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_index_with_visits_successfully()
    {
        ProductLink::factory()->state(['marketer_id' => $this->user])->for($this->product)->has(
            ProductLinkVisit::factory(),
            'visits'
        )->create();
        $response = $this->actingAs($this->user)->getJson(
            route('api.count-visit-product.index', [
                "filters" => [
                    "marketer_id" => $this->user->id,
                    "range" => [
                        "from" => now()->subMinutes(15)->format('Y/m/d H:i:s'),
                        "to" => now()->addMinutes(15)->format('Y/m/d H:i:s')
                    ]
                ]
            ])
        );
        $response->assertJson(fn(AssertableJson $json) => $json->where('data.0.visits_count', 1)->etc());
        $response->assertStatus(200);
    }

    public function test_product_visits_count_successfully()
    {
        ProductLink::factory()->state(['marketer_id' => $this->user])->for($this->product)->has(
            ProductLinkVisit::factory(),
            'visits'
        )->create();
        $response = $this->actingAs($this->user)->getJson(
            route('api.count-visit-product.show', [
                "product" => $this->product,
                "filters" => [
                    "marketer_id" => $this->user->id,
                    "range" => [
                        "from" => now()->subMinutes(15)->format('Y/m/d H:i:s'),
                        "to" => now()->addMinutes(15)->format('Y/m/d H:i:s')
                    ]
                ]
            ])
        );
        $response->assertJson(fn(AssertableJson $json) => $json->where('data.count', 1)->etc());
        $response->assertStatus(200);
    }
}
