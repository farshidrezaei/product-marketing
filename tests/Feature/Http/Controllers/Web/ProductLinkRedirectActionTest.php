<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Jobs\SubmitProductLinkVisitJob;
use App\Models\ProductLink;
use App\Models\ProductLinkVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProductLinkRedirectActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_successfully()
    {
        Queue::fake();


        /** @var ProductLink $productLink */
        $productLink = ProductLink::factory()->state(['marketer_id' => $this->user])->for($this->product)->has(
            ProductLinkVisit::factory(),
            'visits'
        )->create();

        $response = $this->get(route('products.links.redirect', $productLink->slug));

        $response->assertViewIs('product.link.redirect');
        $response->assertSee($this->product->url);

        Queue::assertPushed(SubmitProductLinkVisitJob::class, 1);

    }
}
