<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

            <link rel="icon" href="/favicon.ico" sizes="any">
            <link rel="icon" href="/favicon.svg" type="image/svg+xml">
            <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        </head>
        <body>
            @if ($groep)
                @php
                    $feedUrl = route('calendar.feed', ['opleiding' => $opleiding, 'groep' => $groep]);
                    $webcalUrl = 'webcal://'.request()->getHttpHost().parse_url($feedUrl, PHP_URL_PATH);
                @endphp
                <div class="subbutton">
                    <p>Subscribe to the calendar for {{ $opleiding->naam }} - {{ $groep->naam }}</p>
                </div>
                <div class="options">
                    <ul>
                        <li><a href="{{ $webcalUrl }}">Subscribe (Apple Calendar)</a></li>
                        <li><a href="https://calendar.google.com/calendar/render?cid={{ urlencode($feedUrl) }}">Subscribe (Google Calendar)</a></li>
                        <li><a href="{{ $feedUrl }}">Download / subscribe (.ics link)</a></li>
                    </ul>
                </div>
            @else
                <div class="subbutton">
                    <p>Kies je groep om je eigen kalender-link te krijgen</p>
                </div>
                <div class="options">
                    @forelse ($opleidingen as $opleiding)
                        <p>{{ $opleiding->naam }}</p>
                        <ul>
                            @forelse ($opleiding->groepen as $groepItem)
                                <li>
                                    <a href="{{ route('sub.show', ['opleiding' => $opleiding, 'groep' => $groepItem]) }}">
                                        {{ $groepItem->naam }}
                                    </a>
                                </li>
                            @empty
                                <li>Geen groepen</li>
                            @endforelse
                        </ul>
                    @empty
                        <p>Geen opleidingen gevonden</p>
                    @endforelse
                </div>
            @endif
        </body>

    </html>
