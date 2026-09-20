<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Activiteit;
use App\Http\Controllers\JsonStructureActiviteiten;
use App\Http\Controllers\timeController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AgendaRefresh extends Component
{
    public $result = [];
    public $projection = [];
    public $Times = [];
    public $crudRight = [];

    public function mount()
    {
        $this->index();
    }

    public function index()
    {
        $routeNames = ['studentAgenda', 'dashboard', 'home'];
        $projectionList = [
            'studentAgenda' => ['titel', 'omschrijving', 'starttijd', 'eindtijd', 'locatie', 'type'],
            'dashboard' => ['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door_naam'],
            'home' => ['titel', 'datum', 'starttijd', 'eindtijd', 'type', 'locatie'],
        ];


        $crudSystemRight = [
            'studentAgenda' => false,
            'dashboard' => true,
            'home' => false,
        ];

        $routeName = Route::currentRouteName();

        for ($i = 0; $i < count($routeNames); $i++) {
            if ($routeName == $routeNames[$i]) {
                $this->projection = $projectionList[$routeName] ?? null;
                $this->crudRight = $crudSystemRight[$routeName] ?? null;

                break;
            }
        }

        $activiteiten = Activiteit::select($this->projection)
            ->join('users', 'activiteiten.aangemaakt_door', '=', 'users.id')
            ->addSelect('users.name as aangemaakt_door_naam')
            ->whereDate('datum', now())
            ->orderBy('starttijd', 'asc')
            ->get();



        $timeController = new timeController;
        $this->Times = $timeController->MakeTimeSheet();

        $activiteitenStructure = new JsonStructureActiviteiten;
        $result = $activiteitenStructure->generateActiviteitenJson($this->Times, $activiteiten);
        $this->result = $result;
    }



    public function render()
    {
        return view('livewire.agenda-refresh', [
            'result' => $this->result,
            'projection' => $this->projection,
            'Times' => $this->Times,
            'crudRight' => $this->crudRight,

        ]);
    }
}
