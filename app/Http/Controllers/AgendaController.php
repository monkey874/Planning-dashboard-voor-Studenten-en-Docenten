<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activiteiten_model;
use Illuminate\support\Facades\Route;

class AgendaController extends Controller
{
    public function agenda()
    {
        $this->index();
        $routeNames = ['public board', 'gast board', 'docent board'];
        $projectionList = [
            'public board' => ['titel', 'datum', 'starttijd', 'eindtijd', 'type'],
            'gast board' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'type'],
            'docent board' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'type', 'aangemaakt_door']
        ];

        $routeName = Route::currentRouteName();
        for ($i = 0; $i < count($routeNames); $i++) {
            if ($routeName == $routeNames[$i]) {
                $projection = $projectionList[$routeName];
                break;
            }
        }

        $activiteiten = activiteiten_model::select($projection)
            ->where('datum', '=', now()->format('Y-m-d'))
            ->orderby('starttijd', 'asc')
            ->get();



        return view('agenda', compact('activiteiten', 'projection'));
    }

    public function index()
    {

        $Times = activiteiten_model::select('eindtijd')->orderBy('eindtijd', 'DESC')->first();
        DD($Times);
    }
}
