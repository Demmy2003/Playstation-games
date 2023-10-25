<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class CheckModeratorRole
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole('moderator')) {
            return $next($request);
        }

        // Redirect or return an error response, e.g., abort(403), for unauthorized users
        return redirect()->route('games.index')->with('error', 'You do not have permission to create games.');
    }
}
