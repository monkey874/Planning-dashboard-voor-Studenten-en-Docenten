<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use DateTime;
use App\Http\Controllers\JsonStructureActiviteiten;
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



        $timeController = new timeController;
        $Times = $timeController->MakeTimeSheet();

        $activiteitenStructure = new JsonStructureActiviteiten;
        $result = $activiteitenStructure->generateActiviteitenJson($Times, $activiteiten);



        if (isset($projection, $result, $Times, $crudRight, $view)) {

            return view($view, compact('projection', 'result', 'Times', 'crudRight'));
        } else {
            abort(404);
        }
    }
}
