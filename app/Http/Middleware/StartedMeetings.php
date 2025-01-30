<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StartedMeetings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            $status = Meeting::whereHas('participant', function ($query) use ($user) {
                $query->where('user_id', $user->user_id);
            })
            ->where('status', 'Rapat Dimulai')
            ->orderBy('start_time', 'desc')
            ->get();

            // dd($meetingsss);
            view()->share('status', $status);
        }
        return $next($request);

    }
}
