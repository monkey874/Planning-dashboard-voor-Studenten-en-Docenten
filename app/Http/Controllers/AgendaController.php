<?php

namespace App\Http\Controllers;

use App\Models\activiteiten_model;
use DateTime;
use Illuminate\support\Facades\Route;

class AgendaController extends Controller
{
    public function index()
    {
        $routeNames = ['studentAgenda', 'dashboard', 'home'];
        $projectionList = [
            'studentAgenda' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'type'],
            'dashboard' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'type', 'Auteur'],
            'home' => ['titel', 'datum', 'starttijd', 'eindtijd', 'type'],
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
                $projection = $projectionList[$routeName];
                $view = '/'.$viewList[$routeName];
                $crudRight = $crudSystemRight[$routeName];

                break;
            }
        }

        $activiteiten = activiteiten_model::select($projection)
            ->where('datum', '=', now()->format('d-m-y'))
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
                        'ActiviteitDatum' => $activiteit->datum,
                        'Activiteitstarttijd' => $activiteit->starttijd,
                        'Activiteiteindtijd' => $activiteit->eindtijd,
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

        return view($view, compact('projection', 'result', 'Times', 'crudRight'));
    }
}
