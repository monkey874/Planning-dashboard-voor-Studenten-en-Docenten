<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @props(['projection', 'result','Times', 'crudRight' ])

    @php
    $activityFields = [
    'titel' => 'ActiviteitTitel',
    'omschrijving' => 'ActiviteitOmschrijving',
    'datum' => 'ActiviteitDatum',
    'starttijd' => 'Activiteitstarttijd',
    'eindtijd' => 'Activiteiteindtijd',
    'type' => 'Activiteiteindtype',
    'aangemaakt_door' => 'ActiviteitAangemaakt door',
    ];
    @endphp

</head>


<body class="p-0 m-0">
    <diV>
        <table class="w-full h-full">
            <thead>
                <tr>
                    <td>
                        <x-activitie-border>
                            <x-activitie-row>

                                <x-kolum>
                                    <b>tijd</b>
                                </x-kolum>

                                @foreach($projection as $fields)
                                <x-kolum>
                                    <b>{{ $fields  ?? '' }}</b>
                                </x-kolum>
                                @endforeach

                                @if($crudRight)
                                <x-kolum>
                                    <b>acties</b>
                                </x-kolum>
                                @endif

                            </x-activitie-row>
                        </x-activitie-border>
                    </td>
                </tr>
            </thead>

            <tbody>
                @foreach($result as $slot)
                <tr>
                    <td colspan="{{ count($projection) }}">
                        @if(count($slot['Activiteiten']) > 0)
                        @foreach($slot['Activiteiten'] as $index => $Activiteit)

                        <x-activitie-border>
                            <x-activitie-row>

                                <x-kolum>
                                    <p>{{ $index === 0 ? ($slot['TimeSlot'] ?? $slot['TimeSlot']) : $slot['TimeSlot'] }}</p>
                                </x-kolum>

                                @foreach($projection as $field)
                                <x-kolum>
                                    <p>{{ $Activiteit[$activityFields[$field] ?? $field] ?? '' }}</p>
                                </x-kolum>
                                @endforeach

                                @if($crudRight)
                                <x-kolum>
                                    <div class="gap-4 flex flex-row">
                                        <x-icon-border>
                                            <x-hugeicons-edit-01 class="w-6 h-6 text-black-500" />
                                        </x-icon-border>
                                        <x-icon-border>
                                            <x-heroicon-o-trash class="w-6 h-6 text-black-500" />
                                        </x-icon-border>
                                    </div>
                                </x-kolum>
                                @endif
                            </x-activitie-row>
                        </x-activitie-border>
                        @endforeach
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>