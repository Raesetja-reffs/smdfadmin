<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 1px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h3>{{$header[0]->StoreName}}</h3>
<h3>OrderDate:{{$header[0]->OrderDate}}</h3>
<h3>DeliveryDate:{{$header[0]->DeliveryDate}}</h3>
<h3>By:{{$header[0]->UserName}}</h3>
<h3>{{$header[0]->dtm}}</h3>

<table>
    <tr>
        <th>Code</th>
        <th>Description</th>
        <th>Quantity</th>
    </tr>

    @foreach($lines as $val)
    <tr>
        <td>{{$val->strPartNumber}}</td>
        <td>{{$val->PastelDescription}}</td>
        <td>{{$val->Quantity}}</td>
    </tr>
   @endforeach
</table>

</body>
</html>
