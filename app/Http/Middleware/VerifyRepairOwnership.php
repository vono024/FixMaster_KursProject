<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RepairRequest;

class VerifyRepairOwnership
{
    public function handle(Request $request, Closure $next): Response
    {
        $repairId = $request->route('repair') ?? $request->route('repairRequest');

        if (!$repairId) {
            return $next($request);
        }

        $repair = RepairRequest::findOrFail($repairId);
        $user = auth()->user();

        if ($user->role === 'admin') {
            return $next($request);
        }

        if ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Це не ваша заявка');
        }

        if ($user->role === 'master' && $repair->master_id !== $user->id) {
            abort(403, 'Ця заявка не призначена вам');
        }

        return $next($request);
    }
}
