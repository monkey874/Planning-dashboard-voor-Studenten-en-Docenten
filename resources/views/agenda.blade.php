<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="p-0 m-0">
    <div>
        <table class="border w-full p-0">
            <thead>
                <th class="border p-2 text-left">Tijden</th>
                @foreach ($projection as $projectionField)
                <th class="border p-2 text-left">{{ $projectionField }}</th>
                @endforeach
            </thead>
            <tbody>
                @foreach ($activiteiten as $activiteit)
                <tr class="border h-15  ">
                    <td></td>
                    @if(!empty($activiteit->titel))
                    <td class="border p-3 ">{{ $activiteit->titel }}</td>
                    @endif
                    @if(!empty($activiteit->omschrijving))
                    <td class="border p-3">{{ $activiteit->omschrijving }}</td>
                    @endif
                    @if(!empty($activiteit->datum))
                    <td class="border p-3">{{ $activiteit->datum }}</td>
                    @endif
                    @if(!empty($activiteit->starttijd))
                    <td class="border p-3">{{ $activiteit->starttijd }}</td>
                    @endif
                    @if(!empty($activiteit->eindtijd))
                    <td class="border p-3">{{ $activiteit->eindtijd }}</td>
                    @endif
                    @if(!empty($activiteit->type))
                    <td class="border p-3">{{ $activiteit->type }}</td>
                    @endif
                    @if(!empty($activiteit->aangemaakt_door))
                    <td class="border p-3">{{ $activiteit->aangemaakt_door }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>