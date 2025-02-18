{{-- <!DOCTYPE html>
<html>
<head>
    <title>Undangan Rapat</title>
</head>
<body>
    <h1>{{ $meeting->meeting_theme }}</h1>
    <p>Dear {{ $participant->name }},</p>
    <p>Anda diundang untuk menghadiri rapat dengan detail sebagai berikut:</p>
    <p><strong>Notulensi Rapat:</strong> {{ $meeting->minutes ? $meeting->minutes->name : 'Notulensi Tidak Ditemukan' }}</p>
    <p><strong>Pemimpin Rapat:</strong> {{ $meeting->leader ? $meeting->leader->name : 'Pemimpin Tidak Ditemukan' }}</p>
    <p><strong>Deskripsi:</strong> {{ $meeting->description }}</p>
    <p><strong>Jam Mulai:</strong> {{ $meeting->start_time }}</p>
    {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('F') ?? '' }}
    {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} - {{ \Carbon\Carbon::parse($meeting->end_time)->locale('id')->translatedFormat(' H:i') ?? '' }} WITA
    <p><strong>Jam Selesai:</strong> {{ $meeting->end_time }}</p>
    <p><strong>Ruangan:</strong> {{ $meeting->rooms ? $meeting->rooms->room_name : 'Ruangan Tidak Ditemukan' }}</p>
    <p><strong>Status:</strong> {{ $meeting->status }}</p>
    <p>Terima kasih,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html> --}}



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Rapat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: #d4856f !important;
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
            background-color: #d4856f;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Undangan Rapat SIRAPAT</h1>
        </div>
        <div class="content">
            <h2>Kepada Yth. Bapak/Ibu {{ $participant->name }}</h2>
            <p>Kami mengundang Anda untuk menghadiri rapat <strong>"{{ $meeting->meeting_theme }}"</strong> yang akan diadakan pada:</p>
            <div class="details">
                <p><i class="fas fa-calendar icon"></i><strong>Hari/Tanggal :</strong> {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }} </p>
                <p><i class="fas fa-clock icon"></i><strong>Waktu   :</strong> {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} - {{ \Carbon\Carbon::parse($meeting->end_time)->locale('id')->translatedFormat(' H:i') ?? '' }} WITA</p>
                <p><i class="fas fa-map-marker-alt icon"></i><strong>Lokasi :</strong> {{ $meeting->rooms ? $meeting->rooms->room_name : 'Ruangan Tidak Ditemukan' }}</p>
                <p><i class="fas fa-user icon"></i><strong>Pemimpin Rapat   :</strong> {{ $meeting->leader ? $meeting->leader->name : 'Pemimpin Tidak Ditemukan' }}</p>
            </div>
            <p>Agenda rapat meliputi:
                <br>
                <p>
                    {{ $meeting->description }}
                </p>
            </p>


            <p><i class="fas fa-globe icon"></i>Login situs web kami untuk  memantau informasi jadwal rapat anda di <a href="{{ url('/') }}">http://SIRAPAT.ac.id/</a>.</p><br>
            <p>Terima kasih,</p>
            <p>Sekertaris Rapat</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 SIRAPAT. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
