<?php

namespace App\Http\Controllers;

use App\Models\Groep;
use App\Models\Opleiding;

class SubscriptionController extends Controller
{
    public function index()
    {
        $opleidingen = Opleiding::with('groepen')->orderBy('naam')->get();

        return view('subscription', [
            'opleidingen' => $opleidingen,
            'groep' => null,
        ]);
    }

    public function show(Opleiding $opleiding, Groep $groep)
    {
        abort_unless($groep->opleiding_id === $opleiding->id, 404);

        return view('subscription', [
            'opleidingen' => null,
            'opleiding' => $opleiding,
            'groep' => $groep,
        ]);
    }
}
