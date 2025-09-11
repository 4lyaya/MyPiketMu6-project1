<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Absensi</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 20px;
            color: #374151;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 6px;
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
    <h2>Data Absensi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Guru Absen</th>
                <th>Guru Pengganti</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->absentTeacher->name ?? '-' }}</td>
                    <td>{{ $a->substituteTeacher->name ?? '-' }}</td>
                    <td>{{ $a->classroom->name ?? '-' }}</td>
                    <td>{{ $a->replaced_at->format('d/m/Y') }}</td>
                    <td>{{ implode(', ', $a->getSelectedPeriods()) }}</td>
                    <td>{{ ucfirst($a->reason) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
