<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            /* ... the rest of the rules ... */
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            align-items: center;
            text-align: center;
        }

        .header h2,
        .header h1 {
            margin: 0;
            padding: 0;
        }

        .header h1 {
            margin-bottom: 2px;
        }

        .wrapper {
            padding: 8px 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table tr th,
        .table tr td {
            border: 1px solid #dedede;
            padding: 4px;
        }

        .table tr th {
            background-color: #CECECE;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>