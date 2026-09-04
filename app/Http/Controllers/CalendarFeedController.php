<?php

namespace App\Http\Controllers;

use App\Models\Groep;
use App\Models\Opleiding;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;

class CalendarFeedController extends Controller
{
    public function feed(Opleiding $opleiding, Groep $groep)
    {
        abort_unless($groep->opleiding_id === $opleiding->id, 404);

        $body = cache()->remember("calendar.feed.{$opleiding->id}.{$groep->id}", now()->addMinutes(15), function () use ($opleiding, $groep) {
            $calendar = Calendar::create("{$opleiding->naam} - {$groep->naam}")
                ->productIdentifier('-//VoidAspect//Planning//EN');

            foreach ($groep->activiteiten as $activiteit) {
                $calendar->event(
                    Event::create($activiteit->titel)
                        ->uniqueIdentifier("{$activiteit->id}@voidaspect.tv")
                        ->startsAt($activiteit->datum->setTimeFromTimeString($activiteit->starttijd))
                        ->endsAt($activiteit->datum->setTimeFromTimeString($activiteit->eindtijd))
                        ->description($activiteit->omschrijving ?? '')
                        ->address($activiteit->locatie)
                );
            }

            return $calendar->get();
        });

        return response($body)
            ->header('Content-Type', 'text/calendar; charset=utf-8');
    }
}
