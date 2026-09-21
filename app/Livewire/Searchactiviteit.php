<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activiteit;
use App\Http\Controllers\JsonStructureActiviteiten;
use App\Http\Controllers\timeController;
use DateTime;
use Illuminate\Support\Facades\Route;


use function Laravel\Prompts\search;

class Searchactiviteit extends Component
{
    public $searchText = '';
    public $selectedItem = '';
    public $result = [];
    public $projection = [];

    public function refreshData()
    {
        $this->search();
    }

    public function updatedSearchText(): void
    {
        $this->search();
    }

    public function search()
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
                $this->projection = $projectionList[$routeName] ?? null;
                $view = '/' . $viewList[$routeName] ?? null;
                $crudRight = $crudSystemRight[$routeName] ?? null;

                break;
            }
        }

        if (trim($this->searchText) === '') {
            $this->reset('result');
            $searchResult = Activiteit::select($this->projection)
                ->whereDate('datum', now())
                ->orderby('starttijd', 'asc')
                ->get();
        } else {
            $this->reset('result');
            $searchResult = Activiteit::query()
                ->where('titel', 'like', '%' . trim($this->searchText) . '%')
                ->get();
        }




        $timeController = new timeController;
        $Times = $timeController->MakeTimeSheet();


        $controller = new JsonStructureActiviteiten;
        $result = $controller->generateActiviteitenJson($Times, $searchResult);

        $this->result = $result;
    }

    public function render()
    {
        return view('components.search-activiteit', [
            'result' => $this->result,
            'projection' => $this->projection

        ]);
    }
}
