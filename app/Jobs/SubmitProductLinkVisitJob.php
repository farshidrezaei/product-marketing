<?php

namespace App\Jobs;

use App\Models\ProductLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SubmitProductLinkVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly ProductLink $productLink)
    {
        $this->onQueue('product-link-visit');
    }

    public function handle(): void
    {
        $this->productLink->visits()->create([
            'ip' => request()->ip(),
            'agent' => request()->userAgent()
        ]);
    }

    public function failed(Throwable $throwable): void
    {
        Log::critical('Product Visit Store has been failed.', [
            'message' => $throwable->getMessage(),
            'exception' => get_class($throwable),
            'product_id' => $this->productLink->product->id,
            'product_link_id' => $this->productLink->id,
        ]);
    }
}
