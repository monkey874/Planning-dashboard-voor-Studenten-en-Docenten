<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-agenda :projection="$projection" :result="$result" :Times="$Times" :crudRight="$crudRight">

</x-agenda>