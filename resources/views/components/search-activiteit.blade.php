<div>
    <div class="flex flex-row justify-center w-full p-4 m-4 items-center">

        <input type="text"
            class="p-2  flex flex-row justify-center w-96 focus:outline-none h-12 rounded-l-md border"
            wire:model.live="searchText"
            placeholder="zoek naar een activiteit">
        <div class="flex justify-center items-center h-12 w-12 rounded-r-md  text-black-500 border ">
            <x-hugeicons-search-01 />
        </div>

    </div>

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
        'locatie' => 'ActiviteitLocatie',
        'type' => 'Activiteiteindtype',
        'aangemaakt_door' => 'ActiviteitAangemaakt door',
        ];
        @endphp

    </head>


    <body class="p-0 m-0">
        <diV>
            <table class="w-full h-full" wire:poll="refreshData">
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
</div>