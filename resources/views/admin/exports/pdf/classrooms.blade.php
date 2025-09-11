<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Kelas</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 20px;
            color: #374151;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        h2 {
            margin-bottom: 12px;
            font-size: 1.25rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <h2>Data Kelas</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
