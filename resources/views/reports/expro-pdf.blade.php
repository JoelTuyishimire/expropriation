<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 10px;
            color: #555;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 2px 5px;
        }
        .page-header, .page-header-space {
            height: 100px;
        }

        .page-footer, .page-footer-space {
            height: 50px;

        }

        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid black; /* for demo */
            /*background: #d0e4f5;  */
        }
        .page {
            page-break-after: always;
        }

        @page {
            margin: 20mm
        }
    </style>
</head>
<body>
<div class="page-footer">
    <div style="text-align: left">
        <strong>Address:</strong><span>Kigali-Rwanda</span> <br>
        <strong>Printed by:</strong><span>{{Auth::user()->name}}</span><br>
        <strong>Date:</strong><span>{{Carbon\Carbon::now()->format('d-M-Y')}}</span><br>
    </div>
</div>
<h1 style="text-align: center">{{$title}}</h1>
<table>
    <thead>
    <tr>
        <td>#</td>
        <td>Citizen Name</td>
        <td>Property Type</td>
        <td>Property Address</td>
        <td>Property Price</td>
        <td>Expropriation Status</td>
        <td>Expropriation Date</td>
            <th>Done By</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expropriations ?? []  as $key=>$expopriation)
        <tr>
            <td>{{ ++$key }}</td>

            <td>{{ optional($expopriation->citizen)->name }}</td>
            <td>{{ optional($expopriation->propertyType)->name }}</td>
            <td>{{
                                        optional($expopriation->province)->name
                                       ." - ". optional($expopriation->district)->name ." - ".
                                        optional($expopriation->sector)->name
                                    }}
            </td>
            <td>{{$expopriation->amount}} RWF</td>
            <td>{{$expopriation->created_at}}</td>
            <td>
                <span class="badge badge-{{$expopriation->status_color}}">{{$expopriation->status}}</span>
            </td>
            <td>{{($expopriation->doneBy)->name}}</td>

        </tr>
    @endforeach

    </tbody>
</table>
</body>
</html>
