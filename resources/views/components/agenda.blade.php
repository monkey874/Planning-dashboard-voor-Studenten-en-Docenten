<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @props(['projection', 'result','Times'])

</head>


<body class="p-0 m-0">



    <div>
        <diV>
            <table class="w-full">
                <thead>
                    <tr>
                        <td class="flex flex-row w-auto border p-3  gap-4  bg-zinc-50 items-center   ">
                            <div class="border-r w-2/12">
                                <p>Tijd</p>
                            </div>
                            <div class="border-r w-2/12">
                                <p>Titel</p>
                            </div>
                            <div class="border-r w-3/12">
                                <p>Omschrijving</p>
                            </div>
                            <div class="border-r w-1/12">
                                <p>Datum</p>
                            </div>
                            <div class="border-r w-1/12">
                                <p>Starttijd</p>
                            </div>
                            <div class="border-r w-1/12">
                                <p>Eindtijd</p>
                            </div>
                            <div class="border-r w-1/12">
                                <p>Type</p>
                            </div>
                            <div class="border-r w-1/12">
                                <p>Aangemaakt door</p>
                            </div>
                            <div class="border-r w-1/12">

                            </div>
                        </td>
                    </tr>
                </thead>

                @foreach($result as $slot)
                <tr>
                    <td colspan="{{ count($projection) }} " class="border">
                        @if(count($slot['Activiteiten']) > 0)
                        @foreach($slot['Activiteiten'] as $index => $Activiteit)
                        <div class="flex flex-row">
                            @if($index === 0)
                            <div class="border-r w-2/12">
                                <p>{{ $slot['TimeSlot'] }}</p>
                            </div>
                            @else
                            {{-- Lege placeholder voor inspringing --}}
                            <div class="border-r w-2/12">

                            </div>
                            @endif


                            <div class="flex flex-row w-full border p-3 rounded-xl gap-4 m-3 bg-zinc-50 items-center   ">

                                <div class="border-r w-2/12 ">
                                    <p>{{$Activiteit['ActiviteitTitel']}}</p>
                                </div>
                                <div class="border-r w-3/12">
                                    <p>{{$Activiteit['ActiviteitOmschrijving']}}</p>
                                </div>
                                <div class="border-r w-1/12">
                                    <p>{{ $Activiteit['ActiviteitDatum'] }}</p>
                                </div>
                                <div class="border-r w-1/12">
                                    <p>{{ $Activiteit['Activiteitstarttijd'] }}</p>
                                </div>
                                <div class="border-r w-1/12">
                                    <p>{{ $Activiteit['Activiteiteindtijd'] }}</p>
                                </div>
                                <div class="border-r w-1/12">
                                    <p>{{ $Activiteit['Activiteiteindtype']}}</p>
                                </div>
                                <div class="border-r w-1/12">
                                    <p>{{ $Activiteit['ActiviteitAangemaakt door'] }}</p>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </td>
                </tr>
                @else

                @endif





                @endforeach


            </table>
        </div>
    </div>
</body>