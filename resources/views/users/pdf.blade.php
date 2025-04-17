<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-size: 12px;
            color: #000;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .header {
            margin-bottom: 10px;
        }
        .header h2 {
            text-align: center;
            font-weight: bold;
            color: #4e73df;
            margin: 0;
        }
        .printed-at {
            font-size: 11px;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Data User</h2>
    </div>

    <div class="printed-at">
        Dicetak: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
