<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming invitation slug is a route parameter 'invitation' or 'slug'
        $invitation = $request->route('invitation');

        if (is_string($invitation)) {
            $invitation = \App\Models\Invitation::where('slug', $invitation)->first();
        }

        if (!$invitation) {
            return $next($request);
        }

        $user = $invitation->user;
        $subscription = \App\Models\Subscription::where('user_id', $user->id)
                            ->where('status', 'active')
                            ->where('expires_at', '>', now())
                            ->first();

        if (!$subscription) {
            abort(403, 'Masa aktif undangan ini sudah habis.');
        }

        return $next($request);
    }
}
