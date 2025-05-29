<!DOCTYPE html>
<html>
<head>
    <title>Appointments Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Appointments Report</h2>
    <p>Date Generated: {{ now()->format('F d, Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Total Appointments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $item)
                <tr>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
