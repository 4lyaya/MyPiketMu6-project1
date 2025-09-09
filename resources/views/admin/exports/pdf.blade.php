<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Absensi {{ $teacher->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }

        h2 {
            margin-bottom: 6px;
        }

        .info {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .badge {
            padding: 4px 8px;
            background: #e0e7ff;
            color: #53555b00;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h2>Laporan Absensi</h2>
    <p class="info">
        {{ $teacher ? $teacher->name : 'Semua Guru' }} ·
        {{ $start ? $start->format('d/m/Y') : 'Semua Tanggal' }} -
        {{ $end ? $end->format('d/m/Y') : 'Semua Tanggal' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal Digantikan</th>
                <th>Guru Absen</th>
                <th>Pengganti</th>
                <th>Kelas</th>
                <th>Jam Pelajaran</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $a)
                <tr>
                    <td>{{ $a->replaced_at->format('d/m/Y') }}</td>
                    <td>{{ $a->absentTeacher->name ?? '-' }}</td>
                    <td>{{ $a->substituteTeacher->name ?? '-' }}</td>
                    <td>{{ $a->classroom->name ?? '-' }}</td>
                    <td>
                        @foreach ($a->getSelectedPeriods() as $p)
                            <span class="badge">{{ $p }}</span>
                        @endforeach
                    </td>
                    <td><span class="badge">{{ ucfirst($a->reason) }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
