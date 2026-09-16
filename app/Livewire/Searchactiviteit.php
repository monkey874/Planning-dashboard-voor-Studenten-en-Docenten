<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activiteit;
use App\Http\Controllers\JsonStructureActiviteiten;
use App\Http\Controllers\timeController;
use DateTime;

use function Laravel\Prompts\search;

class Searchactiviteit extends Component
{
    public $searchText = '';
    public $selectedItem = '';
    public $result = [];

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
        if (trim($this->searchText) === '') {
            $this->reset('result');
            $searchResult = Activiteit::select()
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
        return view('components.search-activiteit');
    }
}
