<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class JsonStructureActiviteiten extends Controller
{
    public function generateActiviteitenJson($Times, $activiteitenObject)
    {
        for ($e = 0; $e < count($Times) - 1; $e++) {
            $firstArrayTime = new DateTime($Times[$e]);
            $secondArrayTime = new DateTime($Times[$e + 1]);

            $slotActiviteiten = [];
            foreach ($activiteitenObject as $activiteit) {
                $activiteitTijd = new DateTime($activiteit->starttijd);

                if ($activiteitTijd > $firstArrayTime && $activiteitTijd < $secondArrayTime) {
                    $slotActiviteiten[] = [
                        'ActiviteitTitel' => $activiteit->titel,
                        'ActiviteitOmschrijving' => $activiteit->omschrijving,
                        'ActiviteitDatum' => $activiteit->datum->format('d-m-Y'),
                        'Activiteitstarttijd' => $activiteit->starttijd,
                        'Activiteiteindtijd' => $activiteit->eindtijd,
                        'ActiviteitLocatie' => $activiteit->locatie,
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
        return $result;
    }
}
