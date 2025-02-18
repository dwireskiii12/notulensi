<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoogleCalendarAuthController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/' . env('GOOGLE_CALENDAR_CREDENTIALS_PATH')));
        $client->setRedirectUri(env('GOOGLE_CALENDAR_REDIRECT_URI'));
        $client->setScopes([Google_Service_Calendar::CALENDAR]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/' . env('GOOGLE_CALENDAR_CREDENTIALS_PATH')));
        $client->setRedirectUri(env('GOOGLE_CALENDAR_REDIRECT_URI'));
        $client->setScopes([Google_Service_Calendar::CALENDAR]);

        if ($request->has('code')) {
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->input('code'));

            if (!isset($accessToken['error'])) {
                Storage::put('google-calendar-token.json', json_encode($accessToken));
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return redirect('/')->with('error', 'Failed to authenticate with Google.');
    }
}
