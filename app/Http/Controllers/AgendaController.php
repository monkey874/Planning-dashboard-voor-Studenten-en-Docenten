<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use DateTime;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        $routeNames = ['studentAgenda', 'dashboard', 'home'];
        $projectionList = [
            'studentAgenda' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type'],
            'dashboard' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door'],
            'home' => ['titel', 'datum', 'starttijd', 'eindtijd', 'type', 'locatie'],
        ];

        $viewList = [
            'studentAgenda' => 'welcome',
            'dashboard' => 'dashboard',
            'home' => 'welcome',

        ];

        $crudSystemRight = [
            'studentAgenda' => false,
            'dashboard' => true,
            'home' => false,
        ];

        $routeName = Route::currentRouteName();

        for ($i = 0; $i < count($routeNames); $i++) {
            if ($routeName == $routeNames[$i]) {
                $projection = $projectionList[$routeName] ?? null;
                $view = '/' . $viewList[$routeName] ?? null;
                $crudRight = $crudSystemRight[$routeName] ?? null;

                break;
            }
        }

        $activiteiten = Activiteit::select($projection)
            ->whereDate('datum', now())
            ->orderby('starttijd', 'asc')
            ->get();



        $Times = [];
        $startTime = new DateTime('00:00');
        $endTime = new DateTime('23:59');

        while ($startTime <= $endTime) {
            $Times[] = $startTime->format('H:i');
            $startTime->modify('+15 minutes');
        }
        $result = [];

        for ($e = 0; $e < count($Times) - 1; $e++) {
            $firstArrayTime = new DateTime($Times[$e]);
            $secondArrayTime = new DateTime($Times[$e + 1]);

            $slotActiviteiten = [];
            foreach ($activiteiten as $activiteit) {
                $activiteitTijd = new DateTime($activiteit->starttijd);

                if ($activiteitTijd > $firstArrayTime && $activiteitTijd < $secondArrayTime) {
                    $slotActiviteiten[] = [
                        'ActiviteitTitel' => $activiteit->titel,
                        'ActiviteitOmschrijving' => $activiteit->omschrijving,
                        'ActiviteitDatum' => $activiteit->datum->format('d-m-Y'),
                        'Activiteitstarttijd' => $activiteit->starttijd,
                        'Activiteiteindtijd' => $activiteit->eindtijd,
                        'ActiviteitLocatie' => $activiteit->locatie,
                        'Activiteiteindtype' => $activiteit->type,
                        'ActiviteitAangemaakt door' => $activiteit->aangemaakt_door,
                    ];
                }
            }
            $result[] = [
                'TimeSlot' => $Times[$e],
                'Activiteiten' => $slotActiviteiten,
            ];
        }
        if (isset($projection, $result, $Times, $crudRight, $view)) {

            return view($view, compact('projection', 'result', 'Times', 'crudRight'));
        } else {
            abort(404);
        }
    }
}
