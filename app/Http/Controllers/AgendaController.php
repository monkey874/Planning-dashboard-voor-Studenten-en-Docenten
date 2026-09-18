<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use DateTime;
use App\Http\Controllers\JsonStructureActiviteiten;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $routeNames = ['studentAgenda', 'dashboard', 'home'];
        $projectionList = [
            'studentAgenda' => ['titel', 'omschrijving', 'starttijd', 'eindtijd', 'locatie', 'type'],
            'dashboard' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door_naam'],
            'home' => ['titel', 'datum', 'starttijd', 'eindtijd', 'type', 'locatie'],
        ];

        $viewList = [
            'studentAgenda' => 'studentAgenda',
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
        $date = $request->input('date', now()->toDateString());
        $activiteiten = Activiteit::select($projection)
            ->join('users', 'activiteiten.aangemaakt_door', '=', 'users.id')
            ->addSelect('users.name as aangemaakt_door_naam')
            ->whereDate('datum', $date ?: now())
            ->orderBy('starttijd', 'asc')
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
