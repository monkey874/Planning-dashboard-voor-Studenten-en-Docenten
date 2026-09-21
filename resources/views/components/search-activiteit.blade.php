<div wire:poll.2s="refreshData">
    <div class="flex flex-row justify-center w-full p-4 m-4 items-center">
        <div class="flex flex-row p-3">

            <input type="text"
                class="p-2  flex flex-row justify-center w-96 focus:outline-none h-12 rounded-l-md border"
                wire:model.live="searchText"
                placeholder="zoek naar een activiteit">
            <div class="flex justify-center items-center h-12 w-12 rounded-r-md  text-black-500 border ">
                <flux:icon.magnifying-glass class="size-5" />
            </div>
        </div>
        <div class=" flex flex-row p-3">
            <form action="{{ route('home') }}" method="Get">
                <div class="h-12 w-full rounded-md text-black-500 border flex justify-center m-3">
                    <input
                        type="date"
                        name="date"
                        id="date"
                        onchange="this.form.submit()">
                </div>
            </form>
        </div>


    </div>
    @props(['projection', 'result', 'Times', 'crudRight'])

    @php
    $activityFields = [
    'titel' => 'ActiviteitTitel',
    'omschrijving' => 'ActiviteitOmschrijving',
    'datum' => 'ActiviteitDatum',
    'starttijd' => 'Activiteitstarttijd',
    'eindtijd' => 'Activiteiteindtijd',
    'locatie' => 'ActiviteitLocatie',
    'type' => 'Activiteiteindtype',
    'aangemaakt_door_naam' => 'aangemaakt_door_naam',
    ];
    @endphp

    <div class="p-0 m-0">
        <table class="w-full h-full">
            <thead>
                <tr>
                    <td>
                        <x-activitie-border>
                            <x-activitie-row>

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

                                @foreach($projection as $field)
                                <x-kolum>
                                    <p>{{ $Activiteit[$activityFields[$field] ?? $field] ?? '' }}</p>
                                </x-kolum>
                                @endforeach

                                @if($crudRight)
                                <x-kolum>
                                    <div class="gap-4 flex flex-row">
                                        <x-icon-border>
                                            <flux:icon.pencil class="w-6 h-6 text-black-500" />
                                        </x-icon-border>
                                        <x-icon-border>
                                            <flux:icon.trash class="w-6 h-6 text-black-500" />
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
</div>