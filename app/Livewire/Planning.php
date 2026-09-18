<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activiteit;
use App\Http\Controllers\JsonStructureActiviteiten;
use App\Http\Controllers\timeController;


class Planning extends Component
{
    public $projection = [];
    public $result = [];
    public $Times = [];
    public $crudRight = false;

    public function mount($projection, $result, $Times, $crudRight)
    {
        $this->projection = $projection;
        $this->result = $result;
        $this->Times = $Times;
        $this->crudRight = $crudRight;
    }

    public function refreshData()
    {
        $activiteiten = Activiteit::select($this->projection)
            ->whereDate('datum', now())
            ->orderby('starttijd', 'asc')
            ->get();

        $this->result = (new JsonStructureActiviteiten)->generateActiviteitenJson(
            $this->Times,
            $activiteiten
        );
    }

    public function render()
    {
        return view('livewire.planning');
    }
}
