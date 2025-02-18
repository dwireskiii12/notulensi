<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventAttendee;
use Illuminate\Support\Facades\Storage;

class GoogleCalendarController extends Controller
{
    private function getClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/' . env('GOOGLE_CALENDAR_CREDENTIALS_PATH')));
        $client->setScopes([Google_Service_Calendar::CALENDAR]);

        if (Storage::exists('google-calendar-token.json')) {
            $accessToken = json_decode(Storage::get('google-calendar-token.json'), true);
            $client->setAccessToken($accessToken);

            if ($client->isAccessTokenExpired()) {
                if (isset($accessToken['refresh_token'])) {
                    $client->fetchAccessTokenWithRefreshToken($accessToken['refresh_token']);
                    Storage::put('google-calendar-token.json', json_encode($client->getAccessToken()));
                }
            }
        } else {
            abort(401, 'Unauthorized: No Google Calendar Token Found');
        }

        return $client;
    }

    public function createEvent($meeting)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $startTime = Carbon::parse($meeting->start_time, 'UTC')->setTimezone('Asia/Makassar')->format('Y-m-d\TH:i:sP');
        $endTime = Carbon::parse($meeting->end_time, 'UTC')->setTimezone('Asia/Makassar')->format('Y-m-d\TH:i:sP');
        $attendees = [];

        foreach ($meeting->participants as $participant) {
            $attendees[] = new Google_Service_Calendar_EventAttendee(['email' => $participant->email]);
        }

        $event = new Google_Service_Calendar_Event([
            'summary' => $meeting->meeting_theme,
            'location' => $meeting->rooms->room_name ?? 'Online',
            'description' => $meeting->description ?? 'Meeting created from SIRAPAT JTI FATEK UNTAD',
            'start' => [
                'dateTime' => $startTime,
                'timeZone' => 'Asia/Makassar'
            ],
            'end' => [
                'dateTime' => $endTime,
                'timeZone' => 'Asia/Makassar'
            ],
            'attendees' => $attendees,
        ]);

        $calendarId = 'primary';
        $createdEvent = $service->events->insert($calendarId, $event, ['sendUpdates' => 'all']);

        return response()->json([
            'message' => 'Event created successfully!',
            'event_id' => $createdEvent->getId(),
            'event_link' => $createdEvent->htmlLink
        ]);
    }

    public function updateEvent($meeting)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';

        try {
            $event = $service->events->get($calendarId, $meeting->google_event_id);

            $event->setSummary($meeting->meeting_theme);
            $event->setDescription($meeting->description ?? 'Updated Meeting from SIRAPAT JTI FATEK UNTAD');
            $event->setLocation($meeting->rooms->room_name ?? 'Online');
            $event->setStart([
                'dateTime' => Carbon::parse($meeting->start_time)->setTimezone('Asia/Makassar')->toRfc3339String(),
                'timeZone' => 'Asia/Makassar'
            ]);
            $event->setEnd([
                'dateTime' => Carbon::parse($meeting->end_time)->setTimezone('Asia/Makassar')->toRfc3339String(),
                'timeZone' => 'Asia/Makassar'
            ]);

            $updatedEvent = $service->events->update($calendarId, $meeting->google_event_id, $event, ['sendUpdates' => 'all']);

            return response()->json([
                'message' => 'Event updated successfully!',
                'event_link' => $updatedEvent->htmlLink
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Event not found!'], 404);
        }
    }

    public function deleteEvent($google_event_id)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';

        try {
            $service->events->delete($calendarId, $google_event_id);

            return response()->json([
                'message' => 'Event deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Event not found!'], 404);
        }
    }

    public function getEvents()
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';

        $events = $service->events->listEvents($calendarId, [
            'timeMin' => Carbon::now()->toRfc3339String(),
            'timeMax' => Carbon::now()->addDays(7)->toRfc3339String(),
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ])->getItems();

        $eventList = [];
        foreach ($events as $event) {
            $eventList[] = [
                'id' => $event->getId(),
                'summary' => $event->getSummary(),
                'description' => $event->getDescription(),
                'start_time' => $event->getStart()->dateTime ?? $event->getStart()->date,
                'end_time' => $event->getEnd()->dateTime ?? $event->getEnd()->date,
                'event_link' => $event->htmlLink
            ];
        }

        return response()->json([
            'message' => 'Events retrieved successfully!',
            'events' => $eventList
        ]);
    }

    public function revokeGoogleAccount()
    {
        $client = $this->getClient();

        $tokenPath = storage_path('app/google-calendar-token.json');
        if (Storage::exists('google-calendar-token.json')) {
            $accessToken = json_decode(Storage::get('google-calendar-token.json'), true);
            $client->setAccessToken($accessToken);

            if ($client->getAccessToken()) {
                $client->revokeToken();
            }

            Storage::delete('google-calendar-token.json');
        }
    }
}
