<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoadMeetings
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
            $meetingsss = Meeting::whereHas('participant', function ($query) use ($user) {
                $query->where('user_id', $user->user_id);
            })
            ->where('status', 'Menunggu Dimulai')
            ->orderBy('start_time', 'desc')
            ->take(4)
            ->get();

            // dd($meetingsss);
            view()->share('meetingsss', $meetingsss);
        }
        return $next($request);
    }
}
