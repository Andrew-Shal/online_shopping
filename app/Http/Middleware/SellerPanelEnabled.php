<?php

namespace App\Http\Middleware;

use Closure;

class SellerPanelEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->user = auth()->user();

        if (!$this->user->seller_panel_enabled) return redirect()->back()->with('error', 'You have to first enable the sellers panel');

        return $next($request);
    }
}
