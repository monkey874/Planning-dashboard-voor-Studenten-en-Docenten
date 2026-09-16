<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

            <link rel="icon" href="/favicon.ico" sizes="any">
            <link rel="icon" href="/favicon.svg" type="image/svg+xml">
            <link rel="apple-touch-icon" href="/apple-touch-icon.png">

            @vite(['resources/css/app.css'])
        </head>
        <body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased">
            <div class="mx-auto max-w-2xl px-4 py-12">
                @if ($groep)
                    @php
                        $feedUrl = route('calendar.feed', ['opleiding' => $opleiding, 'groep' => $groep]);
                        $webcalUrl = 'webcal://'.request()->getHttpHost().parse_url($feedUrl, PHP_URL_PATH);
                        $googleUrl = 'https://calendar.google.com/calendar/render?cid='.urlencode($feedUrl);
                        $outlookUrl = 'https://outlook.live.com/calendar/0/addcalendar?url='.urlencode($feedUrl).'&name='.urlencode($opleiding->naam.' - '.$groep->naam);
                    @endphp
                    <div class="mb-8">
                        <p class="text-lg font-semibold text-zinc-900">
                            Subscribe to the calendar for {{ $opleiding->naam }} - {{ $groep->naam }}
                        </p>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="flex items-center justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $webcalUrl }}" class="font-medium text-accent hover:underline">Subscribe (Apple Calendar)</a>
                                <x-qr-code :data="$webcalUrl" class="size-24 shrink-0" />
                            </li>
                            <li class="flex items-center justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $googleUrl }}" class="font-medium text-accent hover:underline">Subscribe (Google Calendar)</a>
                                <x-qr-code :data="$googleUrl" class="size-24 shrink-0" />
                            </li>
                            <li class="flex items-center justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $outlookUrl }}" class="font-medium text-accent hover:underline">Subscribe (Outlook)</a>
                                <x-qr-code :data="$outlookUrl" class="size-24 shrink-0" />
                            </li>
                            <li class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $feedUrl }}" class="font-medium text-accent hover:underline">Download / subscribe (.ics link)</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="mb-8">
                        <p class="text-lg font-semibold text-zinc-900">Kies je groep om je eigen kalender-link te krijgen</p>
                    </div>
                    <div class="space-y-6">
                        @forelse ($opleidingen as $opleiding)
                            <div>
                                <p class="mb-2 font-semibold text-zinc-700">{{ $opleiding->naam }}</p>
                                <ul class="space-y-2">
                                    @forelse ($opleiding->groepen as $groepItem)
                                        <li class="rounded-lg border border-zinc-200 bg-white p-3 shadow-sm">
                                            <a href="{{ route('sub.show', ['opleiding' => $opleiding, 'groep' => $groepItem]) }}" class="font-medium text-accent hover:underline">
                                                {{ $groepItem->naam }}
                                            </a>
                                        </li>
                                    @empty
                                        <li class="text-zinc-500">Geen groepen</li>
                                    @endforelse
                                </ul>
                            </div>
                        @empty
                            <p class="text-zinc-500">Geen opleidingen gevonden</p>
                        @endforelse
                    </div>
                @endif
            </div>
        </body>

    </html>
