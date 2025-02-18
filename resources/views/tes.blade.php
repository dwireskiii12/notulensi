<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notulensi Rapat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .header {
            background-color: #d4856f;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333333;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            font-size: 16px;
            margin: 5px 0;
        }

        .details .icon {
            color: #d4856f;
            margin-right: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #e9967a;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Notulensi Rapat</h2>
        </div>
        <div class="content">
            <p>Kepada Yth. Bapak/Ibu {{ $participant->name }},</p>
            <p>Berikut adalah hasil notulensi rapat <strong>"Tema Rapat"</strong> yang telah diadakan pada:</p>
            <div class="details">
                <p><strong>Hari/Tanggal:</strong>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}</p>
                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} - {{ \Carbon\Carbon::parse($summary->meeting->end_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA</p>
                <p><strong>Lokasi:</strong> {{ $summary->meeting->rooms->room_name ?? 'Tidak ditemukan' }}</p>
                <p><strong>Pemimpin Rapat:</strong> {{ $summary->meeting->leader->name ?? 'Tidak ditemukan' }}</p>
                <p><strong>Sekretaris Rapat:</strong> {{ $summary->meeting->secretary->name ?? 'Tidak ditemukan' }}</p>
                <p><strong>Notulensi Rapat:</strong> {{ $summary->user->name ?? 'Tidak ditemukan' }}</p>
            </div>
            <br>

            <div class="details">
                {!! $summary->summary_result !!}
            </div>
            <p>Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan klarifikasi, jangan ragu untuk menghubungi kami di <a href="mailto:example@example.com">example@example.com</a> atau +62 812-3456-7890.</p>
            <p>Terima kasih atas perhatian dan kerjasamanya.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 SIRAPAT. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
