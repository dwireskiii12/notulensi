{{-- <!DOCTYPE html>
<html>
<head>
    <title>Meeting Summary Published</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
        }
        .content h3 {
            color: #007bff;
        }
        .list-group {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .list-group-item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f7f7f7;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .footer p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Meeting Summary Published</h1>
        </div>

        <div class="content mt-2">
            <p><strong>Tema Rapat:</strong> {{ $summary->meeting->meeting_theme ?? 'Tidak ditemukan' }}</p>
            <p><strong>Pimpinan Rapat:</strong> {{ $summary->meeting->meeting_leader ?? 'Tidak ditemukan' }}</p>
            <p><strong>Sekretaris Rapat:</strong> {{ $summary->meeting->secretary->name ?? 'Tidak ditemukan' }}</p>
            <p><strong>Notulensi Rapat:</strong> {{ $summary->user->name ?? 'Tidak ditemukan' }}</p>
            <p><strong>Ruangan Rapat:</strong> {{ $summary->meeting->room->room_name ?? 'Tidak ditemukan' }}</p>
            <p><strong>Deskripsi Rapat:</strong> {{ $summary->meeting->description ?? 'Tidak ditemukan' }}</p>
            <p><strong>Jadwal Rapat:</strong> {{ $summary->meeting->start_time ?? '' }} sampai {{ $summary->meeting->end_time ?? '' }}</p>

            <p><strong>Jadwal Rapat:</strong>
                {{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y, H:i') ?? '' }}
                sampai
                {{ \Carbon\Carbon::parse($summary->meeting->end_time)->locale('id')->translatedFormat('H:i') ?? '' }}
            </p>


            <p><strong>Jumlah Peserta Rapat:</strong> {{ $summary->meeting->participant_count ?? 'Tidak ditemukan' }}</p>


            <h3>Kesimpulan Rapat</h3>
            <p>{!! strip_tags($summary->summary_result) !!}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SINODA. All rights reserved.</p>
        </div>
    </div>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H HipCorp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container card">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header text-center bg-primary text-white mt-2 mb-2">

                    <h1>Hasil Rapat Fakultas Teknik Universitas Janabadra</h1>
                </div>
                <h5>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}</h5>

                <h3><strong>"{{ $summary->meeting->meeting_theme ?? 'Tidak ditemukan' }}"</strong></h3>
                <p>{{ $summary->meeting->description ?? 'Tidak ditemukan' }}</p>
                <hr>

                <table class="">
                    <tr>
                        <th><h5>
                            Kode Rapat
                            </h5>
                        </th>
                        <td><h5>
                            : #UJBJaya{{ $summary->meeting_id }}
                            </h5></td>
                    </tr>
                    <tr>
                        <th>Pemimpin Rapat</th>
                        <td>: {{ $summary->meeting->leader->name ?? 'Tidak ditemukan' }}</td>
                    </tr>
                    <tr>
                        <th>Sekertaris Rapat</th>
                        <td>: {{ $summary->meeting->secretary->name ?? 'Tidak ditemukan' }}</td>
                    </tr>
                    <tr>
                        <th>Notulensi Rapat</th>
                        <td>: {{ $summary->user->name ?? 'Tidak ditemukan' }}</td>
                    </tr>

                </table>

                <hr>
                <h6>Rapat Telah Selesai Dilaksanakan</h6>
                <table class="table table-striped">
                    <tr>
                        <th width="300px">Jadwal</th>
                        <td width="300px">Mulai</td>
                        <td width="300px">Selesai</td>
                        <td>Ruangan</td>

                    </tr>
                    <tr>
                        <th>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}</th>
                        <td>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA</td>
                        <td> {{ \Carbon\Carbon::parse($summary->meeting->end_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA</td>
<td>{{ $summary->meeting->rooms->room_name ?? 'Tidak ditemukan' }}</td>
                    </tr>
                </table>
                <hr>
                <h3>Kesimpulan Rapat</h3>
                <p>{!! strip_tags($summary->summary_result) !!}</p>
                <hr>

            </div>
        </div>
    </div>
</body>
</html> --}}
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
            <p>Kepada Yth. Bapak/Ibu {{ $recipientName }},</p>
            <p>Berikut adalah hasil notulensi rapat <strong>"Tema Rapat"</strong> yang telah diadakan pada:</p>
            <div class="details">
                <p><strong>Hari/Tanggal:</strong>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}</p>
                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} - {{ \Carbon\Carbon::parse($summary->meeting->end_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA</p>
                <p><strong>Lokasi:</strong> {{ $summary->meeting->rooms->room_name ?? 'Tidak ditemukan' }}</p>
                <p><strong>Pemimpin Rapat:</strong> {{ $summary->meeting->leader->name ?? 'Tidak ditemukan' }}</p>
                {{-- <p><strong>Sekretaris Rapat:</strong> {{ $summary->meeting->secretary->name ?? 'Tidak ditemukan' }}</p> --}}

            </div>
            <br>

            <div class="details">
                <p><strong>Notulensi Rapat:</strong> {{ $summary->user->name ?? 'Tidak ditemukan' }}</p>
                <p><strong>Hasil Rapat:</strong></p>


                    {!! $summary->summary_result !!}


            </div>
            <p><i class="fas fa-globe icon"></i>Login situs web kami untuk  memantau informasi hasil rapat lebih detail di <a href="{{ url('/') }}">http://SIRAPAT.ac.id/</a>.</p><br>
            <p>Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan klarifikasi, jangan ragu untuk menghubungi kami di <a href="dwireski63@@gmail.com

">dwireski63@gmail.com

            </a> atau +62 851-7118-9381.</p>
            <p>Terima kasih atas perhatian dan kerjasamanya.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 SIRAPAT. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
