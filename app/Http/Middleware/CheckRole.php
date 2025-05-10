<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

// class CheckRole
// {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//     public function handle($request, \Closure $next, ...$roles)
// {
//     $user = Auth::user();

//     if (in_array($user->role, $roles)) {
//         return $next($request);
//     }

    //redirect when not login
//     abort(403, 'Unauthorized.');
// }

// }
class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user has required role
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect to appropriate dashboard if user has different role
        if ($user->role === 'ADMIN') {
            return redirect()->route('admin');
        }

        return redirect()->route('user.index');
    }
}
