<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

@foreach($header as $val)
    <a style="background: chocolate;padding: 6px;" href='{!!url("/merchieorderid")!!}/{{$val->ID}}'>{{$val->OrderNumber}}: Time {{$val->dtm}}: {{$val->UserName}}</a><br><br><br>

@endforeach


</body>
</html>
