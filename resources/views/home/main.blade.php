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
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class="antialiased">

    <div id="app">

        <div class="relative flex items-top min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">

            <div class="justify-center w-2/3 max-w-3xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <div class="w-auto text-blue-600 text-3xl font-bold mx-auto"> ChiquitoUrl </div>
                </div>

                <submit-form class="mt-8"></submit-form>

            </div>
        </div>
    </div>

    <script async src="{{mix('js/app.js')}}"></script>

</body>

</html>