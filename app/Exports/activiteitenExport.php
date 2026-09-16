<?php

namespace App\Exports;

use App\Models\Activiteit;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Override;

class activiteitenExport implements FromCollection, WithHeadings
{


    public function collection(): Enumerable
    {
        return Activiteit::select()
            ->whereDate('datum', now())
            ->orderby('starttijd', 'asc')
            ->get();
    }


    public function headings(): array
    {
        return ['id', 'titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type'];
    }
}
