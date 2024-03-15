<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!in_array(session('role'), $roles)) {
            return redirect()->back()->with([
              'flash' => [
                  'type' => 'success',
                  'message' => __('Invalid role'),
              ]
          ])->with('flash.once', true);;
        }

        return $next($request);
    }
}
