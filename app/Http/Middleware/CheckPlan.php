<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\UserPlan;

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        $user = $request->user();

        $activePlan = $user->userPlans()
            ->where('status', 'active')
            ->latest()
            ->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (!$activePlan) {
            return redirect()->route('plans.upgrade')
                ->with('error', 'You need an active plan to access this page.');
        }

        return $next($request);
    }
}
