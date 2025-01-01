<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Logs Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Logs Report</h1>
        <p>Generated on: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Admin</th>
                <th>Action</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log['ID'] }}</td>
                    <td>{{ $log['Admin'] }}</td>
                    <td>{{ $log['Action'] }}</td>
                    <td>{{ $log['Description'] }}</td>
                    <td>{{ $log['Date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Your Company Name - Admin Logs Report</p>
    </div>
</body>
</html> 