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
                            abonneer tot the calendar  {{ $opleiding->naam }} - {{ $groep->naam }}
                        </p>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="flex items-start justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $webcalUrl }}" class="pt-1.5 font-medium text-accent hover:underline">abonneer (Apple Calendar)</a>
                                <details class="shrink-0">
                                    <summary class="cursor-pointer list-none select-none rounded-md border border-zinc-300 px-3 py-1.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                                        Gebruik telefoon
                                    </summary>
                                    <div class="mt-3 flex justify-center">
                                        <x-qr-code :data="$webcalUrl" class="size-32" />
                                    </div>
                                </details>
                            </li>
                            <li class="flex items-start justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $googleUrl }}" class="pt-1.5 font-medium text-accent hover:underline">aboneer (Google Calendar)</a>
                                <details class="shrink-0">
                                    <summary class="cursor-pointer list-none select-none rounded-md border border-zinc-300 px-3 py-1.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                                        Gebruik telefoon
                                    </summary>
                                    <div class="mt-3 flex justify-center">
                                        <x-qr-code :data="$googleUrl" class="size-32" />
                                    </div>
                                </details>
                            </li>
                            <li class="flex items-start justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                                <a href="{{ $outlookUrl }}" class="pt-1.5 font-medium text-accent hover:underline">abonneer (Outlook)</a>
                                <details class="shrink-0">
                                    <summary class="cursor-pointer list-none select-none rounded-md border border-zinc-300 px-3 py-1.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                                        Gebruik telefoon
                                    </summary>
                                    <div class="mt-3 flex justify-center">
                                        <x-qr-code :data="$outlookUrl" class="size-32" />
                                    </div>
                                </details>
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
