<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMasterProfileComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->role === 'master' && !$user->profile_completed) {
            if (!$request->routeIs('master.setup') && !$request->routeIs('master.update-profile')) {
                return redirect()->route('master.setup')
                    ->with('info', 'Будь ласка, заповніть інформацію про себе');
            }
        }

        return $next($request);
    }
}
