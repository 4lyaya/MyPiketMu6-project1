<table style="width:100%; border-collapse:collapse; font-family:'Inter',sans-serif;">
    {{-- HEADING --}}
    <thead>
        <tr style="background:#dbeafe; color:#1e40af;">
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">No</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Tanggal Dibuat</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Guru Absen</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Guru Pengganti</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Kelas</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Jam Pelajaran</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Alasan</th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Tanggal Digantikan
            </th>
            <th style="border:1px solid #bfdbfe; padding:8px; text-align:center; font-weight:600;">Catatan</th>
        </tr>
    </thead>

    {{-- BODY --}}
    <tbody>
        @forelse($absences as $a)
            <tr style="background:#ffffff; color:#374151;">
                <td style="border:1px solid #e5e7eb; padding:8px; text-align:center;">{{ $loop->iteration }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ $a->created_at->format('d/m/Y') }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ $a->absentTeacher->name ?? '-' }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ $a->substituteTeacher->name ?? '-' }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ $a->classroom->name ?? '-' }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">
                    {{ implode(', ', $a->getSelectedPeriods()) }}
                </td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ ucfirst($a->reason) }}</td>
                <td style="border:1px solid #e5e7eb; padding:8px;">
                    {{ $a->replaced_at ? \Carbon\Carbon::parse($a->replaced_at)->format('d/m/Y') : '-' }}
                </td>
                <td style="border:1px solid #e5e7eb; padding:8px;">{{ $a->note ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="border:1px solid #e5e7eb; padding:12px; text-align:center; color:#6b7280;">
                    Tidak ada data absensi untuk periode yang dipilih
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
