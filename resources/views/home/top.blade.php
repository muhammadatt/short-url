<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Short Url</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{mix('css/app.css')}}">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">

    <div id="app">

        <div >

            <div class="text-2xl font-bold m-5 text-color-gray-600">Top 100 Most Visited Urls</div>

            <top-urls></top-urls>

        </div>
    </div>

    <script async src="{{mix('js/app.js')}}"></script>

</body>

</html>