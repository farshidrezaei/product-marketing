<?php

namespace App\Http\Controllers\Web;

use App\Facades\ProductLink;
use App\Http\Controllers\Controller;
use App\Jobs\SubmitProductLinkVisitJob;

class ProductLinkRedirectAction extends Controller
{
    public function __invoke(string $slug)
    {
        $link = ProductLink::findBySlug($slug);

        SubmitProductLinkVisitJob::dispatch($link);

        return view('product.link.redirect', compact('link'));
    }
}
