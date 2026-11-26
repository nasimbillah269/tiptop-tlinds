<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Shows the brand as "Tiptop" everywhere, even where database text
 * (category/post descriptions, settings) still says "TipTop".
 * Case-sensitive, so lowercase "tiptop" in emails/URLs is untouched.
 */
class BrandNameFix
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (! $response instanceof Response) {
            return $response; // skip file downloads, streams, redirects
        }

        $type = (string) $response->headers->get('Content-Type', 'text/html');
        if (! preg_match('#text/|json|xml#i', $type)) {
            return $response;
        }

        $content = $response->getContent();
        if (is_string($content) && str_contains($content, 'TipTop')) {
            $response->setContent(str_replace('TipTop', 'Tiptop', $content));
        }

        return $response;
    }
}
