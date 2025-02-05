<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion List</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        thead tr {
            background-color: 	#9932CC;
            color: #ffffff;
            text-align: center;
        }

        th, td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid 	#9932CC;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        /* Define your styles here */
    </style>
</head>
<body>
    <h1>List of Fashion</h1>
    <table>
        <thead>
            <tr>

                <th>id</th>
                <th>kode_fashion</th>
                <th>nama_fashion</th>
                <th>harga</th>
                <th>photo</th>
                      
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($fashion as $d)
            <tr>
                <th>{{ $d->id}}</th>
                <th>{{ $d->kode_fashion}}</th>
                <th>{{ $d->nama_fashion}}</th>
                <<td style="text-align:right">{{ number_format($d->harga,2) }}</td>
                <th>{{ $d->photo}}</th>

              
                <!-- Add more table cells as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>